<?php
namespace App\JsonRpc;
use Hyperf\DbConnection\Db;
use Hyperf\RpcServer\Annotation\RpcService;
/**
 * Class CalculatorService
 * //,publishTo="consul"
 * @RpcService(name="TestService", protocol="jsonrpc", server="jsonrpc",publishTo="consul")
 */
class TestService implements TestServiceInterface
{
    public function getId(int $v1,int $v2):int
    {
        return $v1 + $v2;
    }


}