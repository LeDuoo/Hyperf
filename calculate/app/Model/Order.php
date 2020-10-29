<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Db;
use Hyperf\DbConnection\Model\Model;
use Hyperf\Utils\Collection;
use Hyperf\Di\Annotation\Inject;
use function App\test;

/**
 * @property $id
 * @property $name
 * @property $gender
 * @property $created_at
 * @property $updated_at
 */
class Order extends Model
{


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order';

    protected $orderId;
    protected $order;
    protected $orderDetail;




    public function getOrder($Id)
    {
        $this->orderId = $Id;
        $this->order = $this->Object_to_Array(Order::query()->where('id',$this->orderId)->first(["user_name","close_at","price","server_id","status","tel","server_name","cover_image","order_sn","total_price","pay_price","check_remark","remark as content","created_at","payment_at","link_name","end_at","link_tel","count"]));
        $this->pay = $this->Object_to_Array((Order::query()->find($this->orderId)->Pay->first(['payment_no','success_at'])));
        $this->refund = $this->Object_to_Array(Order::query()->find($this->orderId)->refund->first(['created_at as apply_time','price as apply_price','remark','refusal_statement']));
        $this->eva = $this->Object_to_Array(Order::query()->find($this->orderId)->eva->first(['id as rid','created_at as created_time']));
        $this->orderDetail = array_merge($this->order,$this->refund,$this->pay,$this->eva);
        return $this->orderDetail;

    }


    public  function Pay(){
        return $this->hasOne(Payment::class,'order_id','id');
    }
    public  function refund(){
        return $this->hasOne(RefundApply::class,'order_id','id');
    }
    public function eva(){
        return $this->hasOne(ServerEvaluation::class,'order_id','id');
    }

    public function Object_to_Array($data)
    {
        return json_decode(json_encode($data),true);
    }
}