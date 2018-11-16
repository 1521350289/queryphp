<?php

declare(strict_types=1);

/*
 * This file is part of the forcodepoem package.
 *
 * The PHP Application Created By Code Poem. <Query Yet Simple>
 * (c) 2018-2099 http://forcodepoem.com All rights reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Admin\App\Service\Login;

// use common\is\repository\menu as repository;
// use queryyetsimple\bootstrap\auth\login;
// use queryyetsimple\http\request;
// use queryyetsimple\support\tree;
use Common\Domain\Entity\App;
use Leevel\Kernel\HandleException;
use Leevel\Auth;
use Leevel\Cache;

/**
 * 验证登录.
 *
 * @author Name Your <your@mail.com>
 *
 * @since 2017.11.23
 *
 * @version 1.0
 */
class Validate
{
    protected $input;
   // // use login;

   //  /**
   //   * HTTP 请求
   //   *
   //   * @var \queryyetsimple\http\request
   //   */
   //  protected $oRequest;

   //  /**
   //   * 后台菜单仓储.
   //   *
   //   * @var \common\is\repository\menu
   //   */
   //  protected $oRepository;

    /**
     * 构造函数.
     *
     * @param \queryyetsimple\http\request $oRequest
     * @param \common\is\repository\menu   $oRepository
     */
    public function __construct(/*request $oRequest, repository $oRepository*/)
    {
        // $this->oRequest = $oRequest;
        // $this->oRepository = $oRepository;
    }

    /**
     * 响应方法.
     *
     * @param array  $input
     * @param string $strCode
     *
     * @return array
     */
    public function handle(array $input/*, $strCode*/)
    {

        $this->input = $input;


        if (!$this->validateCode($input['code'])) {
            throw new HandleException('验证码错误');
        }

        $app = App::where('identity', $input['app_id'])->

        where('key', $input['app_key'])->

        findOne();

        if (!$app->id) {
            throw new HandleException('App was not found.');
        }

        // 校验用户和密码

        $token = hash_hmac('sha256', $input['app_id'].$input['app_key']/*.$input['name'].$input['password']*/, $app->secret);

       // print_r($token);

        $request  = \Leevel::app('request');

        $request->query->set('token', $token);

        //Auth::setTokenName($token);

        Auth::login(['foo' => 'bar']);


        return [
            'token' => $token,
            'userInfo' => ['name' => 'xiaoniiuge'],
            'menusList' => [],
            'authList' => [],
        ];
    }

    /**
     * 对比验证码
     *
     * @param string $strInputCode
     * @param string $strCode
     *
     * @return bool
     */
    protected function validateCode($code)
    {
        $codeFromCache = Cache::get('code_'.$this->input['name']);

        if (false === $codeFromCache) {
            return false;
        }

        return strtoupper($code) === strtoupper($codeFromCache);
    }
}