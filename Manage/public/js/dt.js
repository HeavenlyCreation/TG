/**
 * Created by WangJ on 2016/10/6.
 */

$.extend($.fn.dataTable.defaults, {
    "dom": "<'row'<'col-sm-5'l><'col-sm-7'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-5'i><'col-sm-7'p>>",//默认是lfrtip
    // "dom": "<lf<t>ip>",
    "processing": true,//加载中
    "serverSide": true,//服务器模式（★★★★★重要，本文主要介绍服务器模式）
    "searching": true,//datatables自带的搜索
    // "scrollX": true,//X滑动条
    "pagingType": "full_numbers",//分页模式
    "ajax": {
        "type": "POST"//,//（★★★★★重要）
        //"contentType": "application/json; charset=utf-8"
    },
    "language": {
        url: "../plugin/datatables/locals/zh-cn.json"
    }
});

$.extend($.fn.dataTable.ext.errMode, 'throw');