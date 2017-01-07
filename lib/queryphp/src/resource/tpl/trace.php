<?php
/*
 * [$QueryPHP] A PHP Framework Since 2010.10.03. <Query Yet Simple>
 * ©2010-2017 http://queryphp.com All rights reserved.
 * 
 * @author Xiangmin Liu<635750556@qq.com>
 * @version $$
 * @date 2016.12.18
 * @since 1.0
 */
! defined ( 'Q_PATH' ) && exit ();

/**
 * 系统调试模版
 * 
 * @author Xiangmin Liu
 */
?>
<script type="text/javascript">
console.log( '%c Query Yet Simple [trace] %c(http://www.queryphp.com)', 'color: #8A2BE2;', 'color: #528B8B;' );
<?php foreach ( $arrTrace as $sKey => $sTrace ) : ?>
    <?php if( is_string($sKey) ) : ?>
        console.log('');
        console.log('%c <?php echo $sKey; ?>', 'color: blue; background: #C9C9C9; color: #fff; padding: 8px 15px; -moz-border-radius: 15px; -webkit-border-radius: 15px; border-radius: 15px;');
        console.log('');
    <?php endif; ?>
    <?php if( $sTrace ) : ?>
        console.log('%c<?php echo $sTrace; ?>', 'color: gray;');
    <?php endif; ?>
<?php endforeach; ?>
</script>