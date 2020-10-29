<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Controller;


use Hyperf\HttpServer\Contract\RequestInterface; // 接收请求
use Hyperf\HttpServer\Annotation\AutoController; // 自动路由
use Hyperf\Di\Annotation\Inject;
use Hyperf\DbConnection\Db;
/**
 * Class IndexController
 * @AutoController()
 * @package App\Controller
 */
class IndexController extends AbstractController
{
    /**
     * @Inject()
     * @var \App\JsonRpc\CalculatorServiceInterface
     */

    private $calculatorServices;
    private $orderDetail;
    public function index()
    {
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();

        return [
            'method' => $method,
            'message' => "Hello {$user}.",
        ];
    }

    public function getDetail(RequestInterface $request)
    {
         $Id = (int)$request->input('id',1);
         Db::table('order')->where('id',4)->first();
        $this->orderDetail = $this->calculatorServices->getDetail($Id);
        if ($this->orderDetail['status']==0) {
            if (strtotime($this->orderDetail['end_at']) > time()) {
                $this->orderDetail['finish_time'] = strtotime($this->orderDetail['end_at']) - time();
            } else {
                $this->orderDetail['finish_time'] = 0;
            }
        }
        return $this->orderDetail;

    }

}
