<?php
namespace App\JsonRpc;
use Hyperf\DbConnection\Db;
use Hyperf\RpcServer\Annotation\RpcService;
use \App\Model\Order;
use Hyperf\Di\Annotation\Inject;
/**
 * Class CalculatorService
 * //,publishTo="consul"
 * @RpcService(name="CalculatorService", protocol="jsonrpc", server="jsonrpc",publishTo="consul")
 */
class CalculatorService implements CalculatorServiceInterface
{
    /**
     * @Inject()
     * @var Order1
     */
    private $order;

    public function getDetail(int $Id)
    {
       return $this->order->getOrder($Id);
    }


}