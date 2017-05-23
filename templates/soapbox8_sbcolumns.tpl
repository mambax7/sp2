<{include file="db:soapbox8_header.tpl"}>
<div class="outer">
    <div id="pagenav"><{$pagenav}></div>
    <table class="sbcolumns" cellpadding="0" cellspacing="0" width="100%">
        <tr class="head">
            <th class="center"><{$smarty.const._MD_SOAPBOX8_SBCOLUMNS_COLUMNID}></th>
            <th class="center"><{$smarty.const._MD_SOAPBOX8_SBCOLUMNS_AUTHOR}></th>
            <th class="center"><{$smarty.const._MD_SOAPBOX8_SBCOLUMNS_NAME}></th>
            <th class="center"><{$smarty.const._MD_SOAPBOX8_SBCOLUMNS_DESCRIPTION}></th>
            <th class="center"><{$smarty.const._MD_SOAPBOX8_SBCOLUMNS_TOTAL}></th>
            <th class="center"><{$smarty.const._MD_SOAPBOX8_SBCOLUMNS_WEIGHT}></th>
            <th class="center"><{$smarty.const._MD_SOAPBOX8_SBCOLUMNS_COLIMAGE}></th>
            <th class="center"><{$smarty.const._MD_SOAPBOX8_SBCOLUMNS_CREATED}></th>
            <th class="center"><{$smarty.const._MD_SOAPBOX8_ACTION}></th>
        </tr>
        <{foreach item=sbcolumns from=$sbcolumns}>
            <tr class="<{cycle values='odd, even'}>">
                <td class="center"><{$sbcolumns.columnID}></td>
                <td class="center"><{$sbcolumns.author}></td>
                <td class="center"><{$sbcolumns.name}></td>
                <td class="center"><{$sbcolumns.description}></td>
                <td class="center"><{$sbcolumns.total}></td>
                <td class="center"><{$sbcolumns.weight}></td>
                <td class="center"><img src="<{$xoops_url}>/uploads/soapbox8/images/<{$sbcolumns.colimage}>" alt="sbcolumns"></td>
                <td class="center"><{$sbcolumns.created}></td>
                <td class="center">
                    <a href="sbcolumns.php?op=view&columnID=<{$sbcolumns.columnID}>" title="<{$smarty.const._PREVIEW}>"><img src="<{xoModuleIcons16 search.png}>" alt="<{$smarty.const._PREVIEW}>" title="<{$smarty.const._PREVIEW}>"</a> &nbsp;
                    <{if $xoops_isadmin == true}>
                        <a href="admin/sbcolumns.php?op=edit&columnID=<{$sbcolumns.columnID}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 edit.png}>" alt="<{$smarty.const._EDIT}>" title="<{$smarty.const._EDIT}>"/></a>
                        &nbsp;
                        <a href="admin/sbcolumns.php?op=delete&columnID=<{$sbcolumns.columnID}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 delete.png}>" alt="<{$smarty.const._DELETE}>" title="<{$smarty.const._DELETE}>"</a>
                    <{/if}>
                </td>
            </tr>
        <{/foreach}>
    </table>
</div>
<{$commentsnav}> <{$lang_notice}>
<{if $comment_mode == "flat"}> <{include file="db:system_comments_flat.html"}> <{elseif $comment_mode == "thread"}> <{include file="db:system_comments_thread.html"}> <{elseif $comment_mode == "nest"}> <{include file="db:system_comments_nest.html"}> <{/if}>
<{include file="db:soapbox8_footer.tpl"}>
