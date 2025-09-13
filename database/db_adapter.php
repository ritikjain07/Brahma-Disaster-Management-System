<?php
/**
 * PostgreSQL Adapter for Brahma Disaster Management System
 * 
 * This file provides compatibility between MySQL and PostgreSQL
 * for deployment on Render.com
 */

/**
 * PostgreSQLAdapter class
 * Emulates MySQLi interface for PostgreSQL connections
 */
class PostgreSQLAdapter {
    private $connection;
    public $connect_error;
    public $error;
    private $last_query;
    public $affected_rows;
    private $last_result;
    private $insert_id;
    
    /**
     * Constructor - establishes database connection
     * 
     * @param string $host
     * @param string $username
     * @param string $password
     * @param string $database
     */
    public function __construct($host, $username, $password, $database) {
        $connection_string = "host=$host dbname=$database user=$username password=$password";
        
        try {
            $this->connection = pg_connect($connection_string);
            
            if (!$this->connection) {
                $this->connect_error = pg_last_error();
                return;
            }
            
            // Set timezone to match MySQL default
            $this->query("SET timezone = 'UTC'");
            
        } catch (Exception $e) {
            $this->connect_error = $e->getMessage();
        }
    }
    
    /**
     * Set charset (compatibility method - does nothing in PostgreSQL)
     * 
     * @param string $charset
     * @return bool
     */
    public function set_charset($charset) {
        // PostgreSQL handles UTF-8 differently, so this is just for compatibility
        return true;
    }
    
    /**
     * Execute a query
     * 
     * @param string $sql
     * @return mixed
     */
    public function query($sql) {
        // Convert MySQL syntax to PostgreSQL
        $sql = $this->convertSQLSyntax($sql);
        
        $this->last_query = $sql;
        $result = pg_query($this->connection, $sql);
        
        if (!$result) {
            $this->error = pg_last_error($this->connection);
            return false;
        }
        
        // For INSERT queries, get the last insert ID
        if (stripos($sql, 'INSERT') === 0) {
            // Extract table name
            if (preg_match('/INSERT\s+INTO\s+[\"\']?([^\"\'\s\(]+)/i', $sql, $matches)) {
                $table = $matches[1];
                
                // Try to get the ID of the inserted row
                $id_result = pg_query($this->connection, "SELECT lastval()");
                if ($id_result) {
                    $row = pg_fetch_row($id_result);
                    $this->insert_id = $row[0];
                }
            }
        }
        
        $this->affected_rows = pg_affected_rows($result);
        $this->last_result = $result;
        
        // If it's a SELECT query, return a result object
        if (stripos($sql, 'SELECT') === 0 || stripos($sql, 'SHOW') === 0) {
            return new PostgreSQLResult($result);
        }
        
        return true;
    }
    
    /**
     * Prepare a statement
     * 
     * @param string $sql
     * @return PostgreSQLStatement
     */
    public function prepare($sql) {
        // Convert MySQL syntax to PostgreSQL
        $sql = $this->convertSQLSyntax($sql);
        
        return new PostgreSQLStatement($this->connection, $sql);
    }
    
    /**
     * Get the ID of the last inserted row
     * 
     * @return int
     */
    public function insert_id() {
        return $this->insert_id;
    }
    
    /**
     * Close the database connection
     * 
     * @return bool
     */
    public function close() {
        if ($this->connection) {
            return pg_close($this->connection);
        }
        return true;
    }
    
    /**
     * Convert MySQL syntax to PostgreSQL
     * 
     * @param string $sql
     * @return string
     */
    private function convertSQLSyntax($sql) {
        // Replace backticks with double quotes for identifiers
        $sql = preg_replace('/`([^`]+)`/', '"$1"', $sql);
        
        // Replace AUTO_INCREMENT with SERIAL (for CREATE TABLE statements)
        $sql = str_replace('AUTO_INCREMENT', 'SERIAL', $sql);
        
        // Replace NOW() with CURRENT_TIMESTAMP
        $sql = str_replace('NOW()', 'CURRENT_TIMESTAMP', $sql);
        
        // Replace LIMIT x,y with LIMIT y OFFSET x
        $sql = preg_replace('/LIMIT\s+(\d+),\s*(\d+)/i', 'LIMIT $2 OFFSET $1', $sql);
        
        // Handle SHOW TABLES query
        if (preg_match('/SHOW\s+TABLES/i', $sql)) {
            return "SELECT table_name FROM information_schema.tables WHERE table_schema = 'public'";
        }
        
        // Handle SHOW CREATE TABLE query
        if (preg_match('/SHOW\s+CREATE\s+TABLE\s+[\"\']?([^\"\'\s]+)/i', $sql, $matches)) {
            $table = $matches[1];
            return "SELECT table_name as Table, 
                   'CREATE TABLE ' || table_name || ' (' || string_agg(column_name || ' ' || data_type, ', ') || ')' as \"Create Table\" 
                   FROM information_schema.columns 
                   WHERE table_name = '$table' 
                   GROUP BY table_name";
        }
        
        // Handle DESCRIBE table query
        if (preg_match('/DESCRIBE\s+[\"\']?([^\"\'\s]+)/i', $sql, $matches)) {
            $table = $matches[1];
            return "SELECT column_name as Field, data_type as Type, 
                   CASE is_nullable WHEN 'NO' THEN 'NOT NULL' ELSE 'NULL' END as \"Null\", 
                   column_default as Default 
                   FROM information_schema.columns 
                   WHERE table_name = '$table'";
        }
        
        return $sql;
    }
}

/**
 * PostgreSQLResult class
 * Emulates MySQLi_Result interface for PostgreSQL results
 */
class PostgreSQLResult {
    private $result;
    public $num_rows;
    
    public function __construct($pg_result) {
        $this->result = $pg_result;
        $this->num_rows = pg_num_rows($pg_result);
    }
    
    /**
     * Fetch associative array
     * 
     * @return array|null
     */
    public function fetch_assoc() {
        return pg_fetch_assoc($this->result);
    }
    
    /**
     * Fetch row as numeric array
     * 
     * @return array|null
     */
    public function fetch_row() {
        return pg_fetch_row($this->result);
    }
    
    /**
     * Free result memory
     * 
     * @return bool
     */
    public function free() {
        return pg_free_result($this->result);
    }
}

/**
 * PostgreSQLStatement class
 * Emulates MySQLi_Stmt interface for PostgreSQL prepared statements
 */
class PostgreSQLStatement {
    private $connection;
    private $query;
    private $params = array();
    private $types;
    private $result;
    public $affected_rows;
    public $insert_id;
    public $error;
    
    public function __construct($connection, $query) {
        $this->connection = $connection;
        $this->query = $query;
    }
    
    /**
     * Bind parameters to the prepared statement
     * 
     * @param string $types
     * @param mixed ...$args
     * @return bool
     */
    public function bind_param($types, ...$args) {
        $this->types = $types;
        $this->params = $args;
        return true;
    }
    
    /**
     * Execute the prepared statement
     * 
     * @return bool
     */
    public function execute() {
        // Convert ? placeholders to $1, $2, etc.
        $query = $this->query;
        $count = 1;
        
        while (($pos = strpos($query, '?')) !== false) {
            $query = substr_replace($query, '$'.$count, $pos, 1);
            $count++;
        }
        
        try {
            $this->result = pg_query_params($this->connection, $query, $this->params);
            
            if (!$this->result) {
                $this->error = pg_last_error($this->connection);
                return false;
            }
            
            $this->affected_rows = pg_affected_rows($this->result);
            
            // If it's an INSERT, try to get the inserted ID
            if (stripos($this->query, 'INSERT') === 0) {
                $id_result = pg_query($this->connection, "SELECT lastval()");
                if ($id_result) {
                    $row = pg_fetch_row($id_result);
                    $this->insert_id = $row[0];
                }
            }
            
            return true;
        } catch (Exception $e) {
            $this->error = $e->getMessage();
            return false;
        }
    }
    
    /**
     * Get result from the prepared statement
     * 
     * @return PostgreSQLResult
     */
    public function get_result() {
        if ($this->result) {
            return new PostgreSQLResult($this->result);
        }
        return false;
    }
    
    /**
     * Close the statement
     * 
     * @return bool
     */
    public function close() {
        if ($this->result) {
            pg_free_result($this->result);
        }
        return true;
    }
}

// Function to check if we're on Render and should use PostgreSQL
function isOnRender() {
    return (getenv('RENDER') === 'true' || getenv('DATABASE_URL') !== false);
}

// Function to create database connection based on environment
function createDatabaseConnection() {
    // Check for DATABASE_URL (provided by Render)
    if (getenv('DATABASE_URL')) {
        // Parse the DATABASE_URL to extract connection details
        $database_url = parse_url(getenv('DATABASE_URL'));
        
        $host = $database_url['host'];
        $username = $database_url['user'];
        $password = $database_url['pass'];
        $database = ltrim($database_url['path'], '/');
        $port = isset($database_url['port']) ? $database_url['port'] : 5432;
        
        // Use PostgreSQL adapter
        return new PostgreSQLAdapter($host, $username, $password, $database);
    }
    
    // Get database credentials from environment or config
    $host = defined('DB_HOST') ? DB_HOST : getenv('DB_HOST');
    $username = defined('DB_USERNAME') ? DB_USERNAME : getenv('DB_USERNAME');
    $password = defined('DB_PASSWORD') ? DB_PASSWORD : getenv('DB_PASSWORD');
    $database = defined('DB_NAME') ? DB_NAME : getenv('DB_NAME');
    
    // Check if we're on Render
    if (isOnRender()) {
        // Use PostgreSQL adapter
        return new PostgreSQLAdapter($host, $username, $password, $database);
    } else {
        // Use regular MySQL connection
        return new mysqli($host, $username, $password, $database);
    }
}
?>
