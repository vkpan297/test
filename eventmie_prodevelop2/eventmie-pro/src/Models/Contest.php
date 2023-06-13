<?php

namespace Classiebit\Eventmie\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

use Classiebit\Eventmie\Models\User;
use Classiebit\Eventmie\Models\Transaction;
use Classiebit\Eventmie\Models\Commission;

use Classiebit\Eventmie\Scopes\BulkScope;
use Illuminate\Database\Eloquent\Builder;

class Contest extends Model
{
    protected $guarded = [];

    /**
     * Table used
    */
    protected $table = 'contest';

    // make booking
    public function make_booking($params = [])
    {
        return Contest::create($params);
    }
}
