<?php

namespace Todo;

class TodoItem extends Model
{
    const TABLENAME = 'todos'; // This is used by the abstract model, don't touch

    public static function createTodo($title)
    {
        $query = "INSERT INTO " . static::TABLENAME . "(title, created) VALUES ('$title', now())";
        static::$db->query($query);
        $result =  static::$db->execute();
        return $result;
    }

    public static function updateTodo($todoId, $title, $completed)
    {
        
        $query = "UPDATE " . static::TABLENAME . "  SET title = '$title', completed = '$completed' WHERE id = '$todoId'";        
        static::$db->query($query);
        $result =  static::$db->execute();
        return $result;
    }

    public static function deleteTodo($todoId)
    {
        $query = "DELETE FROM " . static::TABLENAME . " WHERE id = '$todoId'";
        static::$db->query($query);
        $result =  static::$db->execute();
        return $result;
    }

    
    
    // (Optional bonus methods below)
    public static function toggleTodos($completed)
    {
        $query = "UPDATE " . static::TABLENAME . "  SET completed = '$completed'";
        static::$db->query($query);
        $result =  static::$db->execute();
        return $result;
        // TODO: Implement me!
        // This is to toggle all todos either as completed or not completed
    }

    public static function clearCompletedTodos()
    {
        $query = "DELETE FROM " . static::TABLENAME . " WHERE completed = 'true'";
        static::$db->query($query);
        $result =  static::$db->execute();
        return $result;
    }
    
    public static function findAllAndSortByCompleted()
    {
        try {
            $query = "SELECT * FROM " . static::TABLENAME . " WHERE completed = 'true'";
            self::$db->query($query);
            $results = self::$db->resultset();

            if (!empty($results)) {
                return $results;
            } else {
                return [];
            }
        } catch (PDOException $err) {
            return $err->getMessage();
        }
    }

    public static function findAllAndSortByUnCompleted()
    {
        try {
            $query = "SELECT * FROM " . static::TABLENAME . " WHERE completed = 'false'";
            self::$db->query($query);
            $results = self::$db->resultset();

            if (!empty($results)) {
                return $results;
            } else {
                return [];
            }
        } catch (PDOException $err) {
            return $err->getMessage();
        }
    }

    public static function searchText($text){
        try {            
            $query = "SELECT * FROM " . static::TABLENAME . " WHERE title like '%$text%'";
            self::$db->query($query);
            $results = self::$db->resultset();

            if (!empty($results)) {
                return $results;
            } else {
                return [];
            }
        } catch (PDOException $err) {
            return $err->getMessage();
        }
    }
}
