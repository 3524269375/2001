<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandModel extends Model
{
    //
    /**
    * 关联到模型的数据表
    *表
    * @var string
    */
    protected $table = 'brand';
    /**
    * The primary key associated with the table.
    *主键
    * @var string
    */
    protected $primaryKey = 'brand_id';
    /**
    * 表明模型是否应该被打上时间戳
    *时间戳
    * @var bool
    */
    //public $timestamps = false;
    /**
    * 可以被批量赋值的属性.
    *白名单
    * @var array
    */
   // protected $fillable = [];
   /**
   * 不能被批量赋值的属性
   *黑名单
   * @var array
   */
   protected $guarded = [];
}
