<{include file="db:soapbox8_header.tpl"}>
<div class="outer">
    <div id="pagenav"><{$pagenav}></div>
    <table class="sbvotedata" cellpadding="0" cellspacing="0" width="100%">
        <tr class="head">
            <th class="center"><{$smarty.const._MD_SOAPBOX8_SBVOTEDATA_RATINGID}></th>
            <th class="center"><{$smarty.const._MD_SOAPBOX8_SBVOTEDATA_LID}></th>
            <th class="center"><{$smarty.const._MD_SOAPBOX8_SBVOTEDATA_RATINGUSER}></th>
            <th class="center"><{$smarty.const._MD_SOAPBOX8_SBVOTEDATA_RATING}></th>
            <th class="center"><{$smarty.const._MD_SOAPBOX8_SBVOTEDATA_RATINGHOSTNAME}></th>
            <th class="center"><{$smarty.const._MD_SOAPBOX8_SBVOTEDATA_RATINGTIMESTAMP}></th>
            <th class="center"><{$smarty.const._MD_SOAPBOX8_ACTION}></th>
        </tr>
        <{foreach item=sbvotedata from=$sbvotedata}>
            <tr class="<{cycle values='odd, even'}>">
                <td class="center"><{$sbvotedata.ratingid}></td>
                <td class="center"><{$sbvotedata.lid}></td>
                <td class="center"><{$sbvotedata.ratinguser}></td>
                <td class="center"><{$sbvotedata.rating}></td>
                <td class="center"><{$sbvotedata.ratinghostname}></td>
                <td class="center"><{$sbvotedata.ratingtimestamp}></td>
                <td class="center">
                    <a href="sbvotedata.php?op=view&ratingid=<{$sbvotedata.ratingid}>" title="<{$smarty.const._PREVIEW}>"><img src="<{xoModuleIcons16 search.png}>" alt="<{$smarty.const._PREVIEW}>" title="<{$smarty.const._PREVIEW}>"</a> &nbsp;
                    <{if $xoops_isadmin == true}>
                        <a href="admin/sbvotedata.php?op=edit&ratingid=<{$sbvotedata.ratingid}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 edit.png}>" alt="<{$smarty.const._EDIT}>" title="<{$smarty.const._EDIT}>"/></a>
                        &nbsp;
                        <a href="admin/sbvotedata.php?op=delete&ratingid=<{$sbvotedata.ratingid}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 delete.png}>" alt="<{$smarty.const._DELETE}>" title="<{$smarty.const._DELETE}>"</a>
                    <{/if}>
                </td>
            </tr>
        <{/foreach}>
    </table>
</div>
<{$commentsnav}> <{$lang_notice}>
<{if $comment_mode == "flat"}> <{include file="db:system_comments_flat.html"}> <{elseif $comment_mode == "thread"}> <{include file="db:system_comments_thread.html"}> <{elseif $comment_mode == "nest"}> <{include file="db:system_comments_nest.html"}> <{/if}>
<{include file="db:soapbox8_footer.tpl"}>
