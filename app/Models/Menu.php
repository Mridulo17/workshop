<?php

namespace App\Models;

use App\Helpers\ActivityLogHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Menu extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $guarded = ['id'];
    protected static $logName = 'menu';
    protected static $logOnlyDirty = true;
    protected static $logAttributes = ['*'];
    protected static $ignoreChangedAttributes = [];

    public function getDescriptionForEvent(string $eventName): string
    {
        self::$logName = trans('menu/attribute.menu');
        return self::$logName.' '.ActivityLogHelper::eventName($eventName);
    }

    //protected $attributes = ['created_by','updated_by','deleted_by'];
    public function __construct(array $attributes = array())
    {
        $this->setRawAttributes(array(
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id,
        ), true);
        parent::__construct($attributes);
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Menu', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\Models\Menu', 'parent_id')->orderBy('order_by','asc');
    }

    public function userMenuAction()
    {
        return $this->hasMany('App\Models\UserMenuAction', 'menu_id')->orderBy('order_by','asc')->where('status',1);
    }
}
