<?php
/*
 * [$QueryPHP] A PHP Framework Since 2010.10.03. <Query Yet Simple>
 * ©2010-2017 http://queryphp.com All rights reserved.
 * 
 * ##########################################################
 * #   ____                          ______  _   _ ______   #
 * #  /     \       ___  _ __  _   _ | ___ \| | | || ___ \  # 
 * # |   (  ||(_)| / _ \| '__|| | | || |_/ /| |_| || |_/ /  #
 * #  \____/ |___||  __/| |   | |_| ||  __/ |  _  ||  __/   #
 * #       \__   | \___ |_|    \__  || |    | | | || |      #
 * #     Query Yet Simple      __/  |\_|    |_| |_|\_|      #
 * #                          |___ /  Since 2010.10.03      #
 * ##########################################################
 * 
 * @author Xiangmin Liu<635750556@qq.com>
 * @version $$
 * @date 2017.04.13
 * @since 4.0
 */
namespace Q\mvc;

/**
 * 启动程序
 *
 * @author Xiangmin Liu
 */
class bootstrap {
    
    /**
     * 父控制器
     *
     * @var Q\mvc\project
     */
    private $objProject = null;
    
    /**
     * 项目配置
     *
     * @var array
     */
    private $arrOption = [ ];
    
    /**
     * 请求
     *
     * @var Q\mvc\request
     */
    private $objRequest = null;
    
    /**
     * 执行事件流程
     *
     * @var array
     */
    private $arrEvent = [ 
            'check',
            'initProject',
            'request',
            'runApp' 
    ];
    
    /**
     * 构造函数
     *
     * @param Q\mvc\project $objProject            
     * @param array $arrOption            
     * @return void
     */
    public function __construct(project $objProject = null, $arrOption = []) {
        $this->objProject = $objProject;
        $this->arrOption = $arrOption;
    }
    
    /**
     * 执行初始化事件
     *
     * @param $objRequest Q\mvc\request            
     * @return void
     */
    public function run(request $objRequest) {
        $this->objRequest = $objRequest;
        foreach ( $this->arrEvent as $strEvent ) {
            $strEvent = $strEvent . '_';
            $this->{$strEvent} ();
        }
    }
    
    /**
     * 项目初始化验证
     *
     * @return void
     */
    private function check_() {
        // 移除自动转义和过滤全局变量
        \Q::stripslashesMagicquotegpc ();
        if (isset ( $_REQUEST ['GLOBALS'] ) or isset ( $_FILES ['GLOBALS'] )) {
            \Q::errorMessage ( 'GLOBALS not allowed!' );
        }
    }
    
    /**
     * 初始化项目
     *
     * @return void
     */
    private function initProject_() {
        // 注册公共组件命名空间
        \Q::import ( 'common', $this->objProject->path_common, [ 
                'ignore' => [ 
                        'i18n',
                        'option',
                        'theme' 
                ] 
        ] );
        
        // 尝试导入 Composer PSR-4
        \Q::importComposer ( $this->objProject->path_vendor );
        
        // 载入 project 引导文件
        if (is_file ( ($strBootstrap = $this->objProject->path_common . '/bootstrap.php') )) {
            require $strBootstrap;
        }
    }
    
    /**
     * 执行请求
     *
     * @return void
     */
    private function request_() {
        // 运行笑脸初始化应用
        $this->objProject->make ( app::class, project::INIT_APP, $this->arrOption )->run ();
        
        // 完成请求
        $this->objRequest->run ();
    }
    
    /**
     * 执行应用
     *
     * @return void
     */
    private function runApp_() {
        // 创建 & 注册
        $this->objProject->instance ( 'app', ($objApp = $this->objProject->make ( app::class, $this->objRequest->app (), $this->arrOption )->run ()) );
        
        // 运行应用
        $objApp->app ();
    }
}