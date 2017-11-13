<?php
/**
 * Created by PhpStorm.
 * User: s1500631
 * Date: 10.11.2017
 * Time: 13.44
 */

namespace database\connectors;

use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Integer;

//TODO When someone inserts a course define classid by classname. Ask the manager to give name of the class to which it will be used to get the right classid.

class CourseData{
    public static function insertCourse($title,$description,$videoimg,$videopath,$videotime,$showimg,$classname,$istesting,$isshow){
        DB::beginTransaction();
        try{
            $classid = self::getClassid($classname);
            DB::insert('insert into course (title,description,videoimg,videopath,videotime,showimg,class_id,viewnum,learnnum,istesting,isshow,creationtime,updatetime)
            values (?,?,?,?,?,?,?,1,1,?,?,now(),now())',[$title,$description,$videoimg,$videopath,$videotime,$showimg,$classid,$istesting,$isshow]);
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
        }
    }
    public static function getCourse($idortitle){
        try{
            if(is_numeric($idortitle)) return DB::select('select * from course where courseid = ?',[$idortitle])[0];
            else if(is_string($idortitle)) return DB::select('select * from course where title = ?',[$idortitle]);
        }catch(\Exception $exception){}
    }
    /**
     * @param $classname Name of the class.
     * @return mixed returns the classid as an int
     */
    public static function getClassid($classname){
        try{
            return DB::select('select classid from course_class where classname = ?',[$classname])[0]->classid;
        }catch (\Exception $exception){}
    }
    public static function insertClass($classname,$status){
        DB::beginTransaction();
        try{
            DB::insert('insert into course_class (classname,status,creationtime,updatetime) values (?,?,now(),now())',[$classname,$status]);
            DB::commit();
        }catch (\Exception $exception){
            echo('inserting course_class failed');
            DB::rollBack();
        }
    }
    public static function updateViewnum($title){
        DB::beginTransaction();
        try{
            DB::update('update course set viewnum = viewnum + 1 where title = ?',[$title]);
            DB::commit();
        }catch (\Exception $exception){ DB::rollBack();}
    }
    public static function updateLearnnum($title){
        DB::beginTransaction();
        try{
            DB::update('update course set learnnum= learnnum + 1 where title = ?',[$title]);
            DB::commit();
        }catch (\Exception $exception){ DB::rollBack();}
    }
}