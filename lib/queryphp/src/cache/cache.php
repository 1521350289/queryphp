<?php
/*
 * [$QueryPHP] A PHP Framework Since 2010.10.03. <Query Yet Simple>
 * ©2010-2017 http://queryphp.com All rights reserved.
 *
 * @author Xiangmin Liu<635750556@qq.com>
 * @version $$
 * @date 2017.02.15
 * @since 4.0
 */
namespace Q\cache;

/**
 * 缓存抽象类
 *
 * @author Xiangmin Liu
 */
abstract class cache {
    
    /**
     * 缓存惯性配置
     *
     * @var array
     */
    protected $arrOption = [ 
            'cache_time' => 86400,
            'cache_prefix' => '~@' 
    ];
    
    /**
     * 修改配置
     *
     * @param mixed $mixName            
     * @param mixed $mixValue            
     * @param boolean $booMerge            
     * @return array
     */
    public function option($mixName = '', $mixValue = null, $booMerge = true) {
        $arrOption = $this->arrOption;
        if (! empty ( $mixName )) {
            if (is_array ( $mixName )) {
                $arrOption = array_merge ( $arrOption, $mixName );
            } else {
                if (is_null ( $mixValue )) {
                    if (isset ( $arrOption [$mixName] )) {
                        unset ( $arrOption [$mixName] );
                    }
                } else {
                    $arrOption [$mixName] = $mixValue;
                }
            }
            
            if ($booMerge === true) {
                $this->arrOption = $arrOption;
            }
        }
        
        return $arrOption;
    }
    
    /**
     * 获取缓存名字
     *
     * @param string $sCacheName            
     * @param array $arrOption            
     * @return string
     */
    protected function getCacheName_($sCacheName, $arrOption) {
        return $arrOption ['cache_prefix'] . $sCacheName;
    }
}