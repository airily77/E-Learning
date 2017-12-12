<?php
namespace database\connectors;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class ScrollimageData{
    /**
     * @param $imagepath Image file
     * @param $isshow To display now or not.
     */
    public static function insertImage($imagepath,$title,$isshow){
        $imageData  =file_get_contents($imagepath);
        $imageSize = getimagesize($imagepath);
        $filetype = $imageSize['mime'];
        $filename = basename($imagepath,$filetype);
        DB::beginTransaction();
        try{
            DB::insert('insert into scrollimage (image,img_size,img_type,img_name,title,isshow,creationtime,updatetime)
            values (?,?,?,?,?,?,now(),now())',[$imageData,$imageSize[3],$filetype,$filename,$title,$isshow]);
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
        }
    }
    public static function updateIsShow($isshow,$title){
        DB::beginTransaction();
        try{
            DB::update('update scrollimage set isshow = ? where title = ?',[$isshow,$title]);
            DB::commit();
        }catch (Exception $exception){
            DB::rollBack();
        }
    }
    public static function getImage($title){
        try{
            return DB::select('select * from scrollimage where title = ?',[$title])[0];
        }catch(\Exceptio $exception) {}
    }
    public static function getCurrentImages(){
        try{
            return DB::select('select * from scrollimage where isshow = 1');
        }catch(\Exception $exception){}
    }
}