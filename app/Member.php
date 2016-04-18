<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'name',
    ];


    /**************************************************************
     *                      Relationships
     **************************************************************/

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function family()
    {
        return $this->belongsTo(Family::class);
    }

    public function parent()
    {
        return $this->hasOne(Member::class)->where($this->getKey(), $this->parent_id);
    }

    public function children()
    {
        return $this->hasMany(Member::class, 'parent_id', 'id');
    }

    public function children_recursive()
    {
        return $this->children()->with('children_recursive');
    }


    /**************************************************************
     *                      Helpers
     **************************************************************/

    /**
     * Attach member to family
     *
     * @param Family $family
     * @return bool
     */
    public function attachToFamily(Family $family)
    {
        $this->family()->associate($family);

        return $this->save();
    }

    /**
     * Set member as a child of another member
     *
     * @param $parent
     * @return bool
     */
    public function isChildOf($parent)
    {
        $this->parent_id = $parent->id;

        return $this->save();
    }

    /**
     * Set member as a family root
     *
     * @return bool
     */
    public function makeFamilyRoot()
    {
        $this->parent_id = null;

        return $this->save();
    }

    /**
     * Check if user belongs to any family or not
     *
     * @return bool
     */
    public function belongsToFamily()
    {
        return !is_null($this->family_id);
    }
}
