<?php
class Database
{
    protected $connection = null;
    public function __construct()
    {
        try {
            $this->connection = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE_NAME);
    	
            if ( mysqli_connect_errno()) {
                throw new Exception("Could not connect to database.");   
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());   
        }			
    }

    /** Update query */
    public function update($query = "" , $params = [])
    {
        try {
            $stmt = $this->executeStatement( $query , $params );
            $result = $stmt->get_result();				
            $stmt->close();
            return $result;
        } catch(Exception $e) {
            throw New Exception( $e->getMessage() );
        }
        return false;
    }

     /** Delete query */
     public function delete($query = "" , $params = [])
     {
         try {
             $stmt = $this->executeStatement( $query , $params );
             $result = $stmt->get_result();				
             $stmt->close();
             return $result;
         } catch(Exception $e) {
            echo $e;
             throw New Exception( $e->getMessage() );
         }
         return false;
     }

    /** Insert query */
    public function insert($query = "" , $params = [])
    {
        try {
            $stmt = $this->executeStatement( $query , $params );
            $result = $stmt->get_result();				
            $stmt->close();
            return $result;
        } catch(Exception $e) {
            throw New Exception( $e->getMessage() );
        }
        return false;
    }

    /** Select query */
    public function select($query = "" , $params = [])
    {
        try {
            $stmt = $this->executeStatement( $query , $params );
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);				
            $stmt->close();
            return $result;
        } catch(Exception $e) {
            echo $e;
            throw New Exception( $e->getMessage() );
        }
        return false;
    }

    /** Create new user query */
    public function signup($query = "" , $params = [])
    {
        try {
 
            $stmt = $this->executeStatement( $query , $params );
            $result = $stmt->get_result();				
            $stmt->close();
            echo $result;
            return $result;

        } catch(Exception $e) {
echo $e;
            throw New Exception( $e->getMessage() );
        }
        
        return false;
    }

    /** User login query */
    public function login($query = "" , $params = [])
    {
        try {
 
            $stmt = $this->executeStatement( $query , $params );
            $result = $stmt->get_result();				
            $stmt->close();

                if(mysqli_fetch_row($result) > 0){
                    return "success";
                }else{
                    return "Fail";
                }
                return "Fail";

        } catch(Exception $e) {
echo $e;
            throw New Exception( $e->getMessage() );
        }
        return false;
    }




    /** Execute statements */
    private function executeStatement($query = "" , $params = [])
    {
        try {
            $stmt = $this->connection->prepare( $query );
            if($stmt === false) {
                throw New Exception("Unable to do prepared statement: " . $query);
            }
            if( $params ) {
                $stmt->bind_param($params[0], $params[1]);
            }
            $stmt->execute();
            return $stmt;
        } catch(Exception $e) {
            throw New Exception( $e->getMessage() );
        }	
    }
}