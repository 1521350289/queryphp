<?php
// (c) 2018 http://your.domain.com All rights reserved.

/**
 * 应用全局配置文件
 *
 * @author Xiangmin Liu <635750556@qq.com>
 * @package $$
 * @since 2016.11.19
 * @version 1.0
 */
return [

    /**
     * ---------------------------------------------------------------
     * 运行环境
     * ---------------------------------------------------------------
     *
     * 根据不同的阶段设置不同的开发环境
     * 可以为 production : 生产环境 testing : 测试环境 development : 开发环境
     */
    'environment' => env('environment', 'development'),

    /**
     * ---------------------------------------------------------------
     * 是否打开调试模式
     * ---------------------------------------------------------------
     *
     * 打开调试模式可以显示更多精确的错误信息
     */
    'debug' => env('debug', false),

    /**
     * ---------------------------------------------------------------
     * 默认调试模式的驱动
     * ---------------------------------------------------------------
     *
     * 支持系统默认的调试和 whoops 来调试错误信息
     * 支持的可选值为 default 和 whppos
     */
    'debug_driver' => env('debug_driver', 'default'),

    /**
     * ---------------------------------------------------------------
     * 自定义异常模板
     * ---------------------------------------------------------------
     *
     * 如果未填写表示使用系统的异常模板
     * 仅支持系统默认模板调试情况
     */
    'custom_exception_template' => '',

    /**
     * ---------------------------------------------------------------
     * 默认异常错误消息
     * ---------------------------------------------------------------
     *
     * 使用默认消息避免暴露重要的错误消息给用户
     * 仅支持系统默认模板调试情况
     * 仅在未开启 DEBUG 模式下面有效
     */
    'custom_exception_message' => '',

    /**
     * ---------------------------------------------------------------
     * 自定义命名空间 （ 名字 = 入口路径）
     * ---------------------------------------------------------------
     *
     * 你可以在这里设置你应用程序的自定义命名空间
     * 相关文档请访问 [执行流程.MVC\命名空间与自动载入.Namespace.Autoload]
     * 如果在 composer.json 注册过，则不会被重复注册，用于未在 composer 注册临时接管
     * see https://github.com/hunzhiwange/document/blob/master/execution-flow/namespace-and-autoload.md
     */
    'namespace' => [],

    /**
     * ---------------------------------------------------------------
     * 服务提供者
     * ---------------------------------------------------------------
     *
     * 这里的服务提供者为类的名字，例如 common\is\provider\event
     * 每一个服务提供者必须包含一个 register 方法，还可以包含一个 bootstrap 方法
     * 系统所有 register 方法注册后，bootstrap 才开始执行以便于调用其它服务提供者 register 注册的服务
     * 相关文档请访问 [系统架构\应用服务提供者]
     * see https://github.com/hunzhiwange/document/blob/master/system-architecture/service-provider.md
     */
    'provider' => [

        // 框架服务提供者
        'Queryyetsimple\Auth\Provider\Register',
        'Queryyetsimple\Cache\Provider\Register',
        'Queryyetsimple\Cookie\Provider\Register',
        'Queryyetsimple\Database\Provider\Register',
        'Queryyetsimple\Encryption\Provider\Register',
        'Queryyetsimple\Event\Provider\Register',
        'Queryyetsimple\Filesystem\Provider\Register',
        'Queryyetsimple\I18n\Provider\Register',
        'Queryyetsimple\Log\Provider\Register',
        'Queryyetsimple\Mail\Provider\Register',
        'Queryyetsimple\Mvc\Provider\Register',
        'Queryyetsimple\Option\Provider\Register',
        'Queryyetsimple\Page\Provider\Register',
        'Queryyetsimple\Queue\Provider\Register',
        'Queryyetsimple\Router\Provider\Register',
        'Queryyetsimple\Session\Provider\Register',
        'Queryyetsimple\Swoole\Provider\Register',
        'Queryyetsimple\Throttler\Provider\Register',
        'Queryyetsimple\Validate\Provider\Register',
        'Queryyetsimple\View\Provider\Register',

        // 应用服务提供者
        'common\is\provider\event'
    ],

    /**
     * ---------------------------------------------------------------
     * 系统运行模板基础路径
     * ---------------------------------------------------------------
     *
     * 系统模板的基础路径，相对于项目而言的路径
     */
    'system_path' => 'common/ui/system',    

    /**
     * ---------------------------------------------------------------
     * 系统运行模板
     * ---------------------------------------------------------------
     *
     * 系统运行过程中的相关模板，异常，调试等等
     */
    'system_template' => [
        'error' => 'error.php',
        'exception' => 'exception.php',
        'trace' => 'trace.php',
        'url' => 'url.php'
    ],

    /**
     * ---------------------------------------------------------------
     * 严格事件匹配模式
     * ---------------------------------------------------------------
     *
     * 是否启用严格事件通配符匹配模式,使用启用严格匹配，参数匹配正则结尾会加入 $ 标志
     * see \Queryyetsimple\Event\Dispatch::prepareRegexForWildcard
     */
    'event_strict' => false,

    /**
     * ---------------------------------------------------------------
     * 中间件分组
     * ---------------------------------------------------------------
     *
     * 分组可以很方便地批量调用组件
     */
    'middleware_group' => [
        'web' => [
            'session'
        ],

        'api' => [
            'throttler:60,1'
        ],

        'common' => [
            'log'
        ]
    ],

    /**
     * ---------------------------------------------------------------
     * 中间件别名
     * ---------------------------------------------------------------
     *
     * HTTP 中间件提供一个方便的机制来过滤进入应用程序的 HTTP 请求
     * 例外在应用执行结束后响应环节也会调用 HTTP 中间件
     */
    'middleware_alias' => [
        'session' => 'Queryyetsimple\Session\Middleware\Session',
        'throttler' => 'Queryyetsimple\Throttler\Middleware\Throttler',
        'log' => 'Queryyetsimple\Log\Middleware\Log'
    ],

    /**
     * ---------------------------------------------------------------
     * 自定义命令
     * ---------------------------------------------------------------
     *
     * 如果你创建了一个命令，你需要在这里注册这个命令
     * 命令一行一条，直接书写完整的命名空间类
     */
    'console' => [],

    /**
     * ---------------------------------------------------------------
     * 默认应用
     * ---------------------------------------------------------------
     *
     * 默认应用非常重要，与路由解析息息相关
     */
    'default_app' => 'home',

    /**
     * ---------------------------------------------------------------
     * 默认控制器
     * ---------------------------------------------------------------
     *
     * 未指定的控制器，此时会默认指定为此控制器
     */
    'default_controller' => 'index',

    /**
     * ---------------------------------------------------------------
     * 默认方法
     * ---------------------------------------------------------------
     *
     * 未指定的方法，此时会默认指定为此方法
     */
    'default_action' => 'index',

    /**
     * ---------------------------------------------------------------
     * 默认响应方式
     * ---------------------------------------------------------------
     *
     * default 为默认的解析方式
     * api 接口模式，json、view 和默认返回 api 格式数据
     */
    'default_response' => 'default',

    /**
     * ---------------------------------------------------------------
     * 约定请求方法
     * ---------------------------------------------------------------
     *
     * 系统约束后台请求类型，通过 $_POST['_method'] 判断
     */
    'var_method' => '_method',

    /**
     * ---------------------------------------------------------------
     * 约定 ajax
     * ---------------------------------------------------------------
     *
     * 系统约束后台 ajax，通过$参数['_ajax'] 判断
     * 所有参数不包含文件参数 $_FILES
     */
    'var_ajax' => '_ajax',

    /**
     * ---------------------------------------------------------------
     * 约定 pjax
     * ---------------------------------------------------------------
     *
     * 系统约束后台 pjax，通过$参数['_pjax'] 判断
     * $参数不包含文件参数 $_FILES
     */
    'var_pjax' => '_pjax',

    /**
     * ---------------------------------------------------------------
     * Gzip 压缩
     * ---------------------------------------------------------------
     *
     * 启用页面 gzip 压缩，需要系统支持 gz_handler 函数
     */
    'start_gzip' => true,

    /**
     * ---------------------------------------------------------------
     * 系统时区
     * ---------------------------------------------------------------
     *
     * 此配置用于 date_default_timezone_set 应用设置系统时区
     * 此功能会影响到 date.time 相关功能
     */
    'time_zone' => 'Asia/Shanghai',

    /**
     * ---------------------------------------------------------------
     * 安全 key
     * ---------------------------------------------------------------
     *
     * 请妥善保管此安全 key,防止密码被人破解
     * \Queryyetsimple\Encryption\Encryption 安全 key
     */
    'auth_key' => env('app_auth_key', '7becb888f518b20224a988906df51e05'),

    /**
     * ---------------------------------------------------------------
     * 安全过期时间
     * ---------------------------------------------------------------
     *
     * 0 表示永不过期
     * \Queryyetsimple\Encryption\Encryption 安全过期时间
     */
    'auth_expiry' => 0,

    /**
     * ---------------------------------------------------------------
     * url 模式
     * ---------------------------------------------------------------
     *
     * default = 普通，pathinfo = pathinfo 模式
     */
    'model' => 'pathinfo',

    /**
     * ---------------------------------------------------------------
     * 是否开启重写
     * ---------------------------------------------------------------
     *
     * 开启了重写将会去掉 生成的 url 中的入口文件 index.php
     */
    'rewrite' => false,

    /**
     * ---------------------------------------------------------------
     * 伪静态后缀
     * ---------------------------------------------------------------
     *
     * 系统进行路由解析时将会去掉后缀后然后继续执行 url 解析
     */
    'html_suffix' => '.html',

    /**
     * ---------------------------------------------------------------
     * 缓存路由
     * ---------------------------------------------------------------
     *
     * 设置路由解析后，系统会将所有路由一并缓存到一个文件中免去分析开销从而提高系统运行性能
     */
    'router_cache' => true,

    /**
     * ---------------------------------------------------------------
     * 严格 router 匹配模式
     * ---------------------------------------------------------------
     *
     * 是否启用严格 router 匹配模式,使用启用严格匹配，路由匹配正则结尾会加入 $ 标志
     */
    'router_strict' => false,

    /**
     * ---------------------------------------------------------------
     * 是否开启域名路由解析
     * ---------------------------------------------------------------
     *
     * 开启域名解析路由会首先去尝试匹配域名中是否存在路由
     */
    'router_domain_on' => true,

    /**
     * ---------------------------------------------------------------
     * 顶级域名
     * ---------------------------------------------------------------
     *
     * 例如 queryphp.com，用于路由解析以及 \Queryyetsimple\Router\Router::url 生成
     */
    'router_domain_top' => env('router_domain_top', ''),

    /**
     * ---------------------------------------------------------------
     * url 生成是否开启子域名
     * ---------------------------------------------------------------
     *
     * 开启 url 子域名功能，用于 \Queryyetsimple\Router\Router::url 生成
     */
    'make_subdomain_on' => false,

    /**
     * ---------------------------------------------------------------
     * public　资源地址
     * ---------------------------------------------------------------
     *
     * 设置公共资源 url 地址
     */
    'public' => env('url_public', 'http://public.foo.bar'),

    /**
     * ---------------------------------------------------------------
     * pathinfo 是否自动 restinfo 解析
     * ---------------------------------------------------------------
     *
     * 当系统路由匹配失败后将会进行 pathinfo 解析
     * 系统可以为 restful 提供智能解析
     *
     * @see \Queryyetsimple\Router\Router::pathinfoRestful
     */
    'pathinfo_restful' => true,

    /**
     * ---------------------------------------------------------------
     * pathinfo 是否自动 restinfo 解析
     * ---------------------------------------------------------------
     *
     * 系统进行 pathinfo 解析时将存在这个数组中的值放入参数
     * 其中如果是数字系统默认也会放进去
     * see \Queryyetsimple\Router\Router:parsePathInfo
     */
    'args_protected' => [],

    /**
     * ---------------------------------------------------------------
     * args 匹配正则
     * ---------------------------------------------------------------
     *
     * 系统进行 pathinfo 解析时将匹配数据放入参数
     * regex 是对 args_protected 的一种补充
     * 例如:['[0-9]+', '[a-z]+']
     * see \Queryyetsimple\Router\Router::parsePathInfo
     */
    'args_regex' => ['[0-9]+', 'v([0-9])+'],

    /**
     * ---------------------------------------------------------------
     * 严格 args 匹配模式
     * ---------------------------------------------------------------
     *
     * 是否启用严格 args 匹配模式,使用启用严格匹配，参数匹配正则结尾会加入 $ 标志
     * see \Queryyetsimple\Router\Router::parsePathInfo
     */
    'args_strict' => false,

    /**
     * ---------------------------------------------------------------
     * 严格中间件匹配模式
     * ---------------------------------------------------------------
     *
     * 是否启用严格中间件匹配模式,使用启用严格匹配，参数匹配正则结尾会加入 $ 标志
     * see \Queryyetsimple\Router\Router::getMiddleware
     */
    'middleware_strict' => false,

    /**
     * ---------------------------------------------------------------
     * 严格 HTTP 方法匹配模式
     * ---------------------------------------------------------------
     *
     * 是否启用严格 HTTP 方法匹配模式,使用启用严格匹配，参数匹配正则结尾会加入 $ 标志
     * see \Queryyetsimple\Router\Router::getMethod
     */
    'method_strict' => false,

    /**
     * ---------------------------------------------------------------
     * 模板控制器目录
     * ---------------------------------------------------------------
     *
     * 系统指定的模板控制器目录，建议不用更改
     * see \Queryyetsimple\Router\Router::parseDefaultBind
     */
    'controller_dir' => 'app\controller'
];
