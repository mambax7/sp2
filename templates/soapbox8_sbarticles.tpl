<{include file="db:soapbox8_header.tpl"}>
<div class="outer">
    <div id="pagenav"><{$pagenav}></div>
    <table class="sbarticles" cellpadding="0" cellspacing="0" width="100%">
        <tr class="head">
            <th class="center"><{$smarty.const._MD_SOAPBOX8_SBARTICLES_ARTICLEID}></th>
            <th class="center"><{$smarty.const._MD_SOAPBOX8_SBARTICLES_COLUMNID}></th>
            <th class="center"><{$smarty.const._MD_SOAPBOX8_SBARTICLES_HEADLINE}></th>
            <th class="center"><{$smarty.const._MD_SOAPBOX8_SBARTICLES_LEAD}></th>
            <th class="center"><{$smarty.const._MD_SOAPBOX8_SBARTICLES_BODYTEXT}></th>
            <th class="center"><{$smarty.const._MD_SOAPBOX8_SBARTICLES_TEASER}></th>
            <th class="center"><{$smarty.const._MD_SOAPBOX8_SBARTICLES_UID}></th>
            <th class="center"><{$smarty.const._MD_SOAPBOX8_SBARTICLES_SUBMIT}></th>
            <th class="center"><{$smarty.const._MD_SOAPBOX8_SBARTICLES_DATESUB}></th>
            <th class="center"><{$smarty.const._MD_SOAPBOX8_SBARTICLES_COUNTER}></th>
            <th class="center"><{$smarty.const._MD_SOAPBOX8_SBARTICLES_WEIGHT}></th>
            <th class="center"><{$smarty.const._MD_SOAPBOX8_SBARTICLES_HTML}></th>
            <th class="center"><{$smarty.const._MD_SOAPBOX8_SBARTICLES_SMILEY}></th>
            <th class="center"><{$smarty.const._MD_SOAPBOX8_SBARTICLES_XCODES}></th>
            <th class="center"><{$smarty.const._MD_SOAPBOX8_SBARTICLES_BREAKS}></th>
            <th class="center"><{$smarty.const._MD_SOAPBOX8_SBARTICLES_BLOCK}></th>
            <th class="center"><{$smarty.const._MD_SOAPBOX8_SBARTICLES_ARTIMAGE}></th>
            <th class="center"><{$smarty.const._MD_SOAPBOX8_SBARTICLES_VOTES}></th>
            <th class="center"><{$smarty.const._MD_SOAPBOX8_SBARTICLES_RATING}></th>
            <th class="center"><{$smarty.const._MD_SOAPBOX8_SBARTICLES_COMMENTABLE}></th>
            <th class="center"><{$smarty.const._MD_SOAPBOX8_SBARTICLES_OFFLINE}></th>
            <th class="center"><{$smarty.const._MD_SOAPBOX8_SBARTICLES_NOTIFYPUB}></th>
            <th class="center"><{$smarty.const._MD_SOAPBOX8_ACTION}></th>
        </tr>
        <{foreach item=sbarticles from=$sbarticles}>
            <tr class="<{cycle values='odd, even'}>">
                <td class="center"><{$sbarticles.articleID}></td>
                <td class="center"><{$sbarticles.columnID}></td>
                <td class="center"><{$sbarticles.headline}></td>
                <td class="center"><{$sbarticles.lead}></td>
                <td class="center"><{$sbarticles.bodytext}></td>
                <td class="center"><{$sbarticles.teaser}></td>
                <td class="center"><{$sbarticles.uid}></td>
                <td class="center"><{$sbarticles.submit}></td>
                <td class="center"><{$sbarticles.datesub}></td>
                <td class="center"><{$sbarticles.counter}></td>
                <td class="center"><{$sbarticles.weight}></td>
                <td class="center"><{$sbarticles.html}></td>
                <td class="center"><{$sbarticles.smiley}></td>
                <td class="center"><{$sbarticles.xcodes}></td>
                <td class="center"><{$sbarticles.breaks}></td>
                <td class="center"><{$sbarticles.block}></td>
                <td class="center"><{$sbarticles.artimage}></td>
                <td class="center"><{$sbarticles.votes}></td>
                <td class="center"><{$sbarticles.rating}></td>
                <td class="center"><{$sbarticles.commentable}></td>
                <td class="center"><{$sbarticles.offline}></td>
                <td class="center"><{$sbarticles.notifypub}></td>
                <td class="center">
                    <a href="sbarticles.php?op=view&articleID=<{$sbarticles.articleID}>" title="<{$smarty.const._PREVIEW}>"><img src="<{xoModuleIcons16 search.png}>" alt="<{$smarty.const._PREVIEW}>" title="<{$smarty.const._PREVIEW}>"</a> &nbsp;
                    <{if $xoops_isadmin == true}>
                        <a href="admin/sbarticles.php?op=edit&articleID=<{$sbarticles.articleID}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 edit.png}>" alt="<{$smarty.const._EDIT}>" title="<{$smarty.const._EDIT}>"/></a>
                        &nbsp;
                        <a href="admin/sbarticles.php?op=delete&articleID=<{$sbarticles.articleID}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 delete.png}>" alt="<{$smarty.const._DELETE}>" title="<{$smarty.const._DELETE}>"</a>
                    <{/if}>
                </td>
            </tr>
        <{/foreach}>
    </table>
</div>
<{$commentsnav}> <{$lang_notice}>
<{if $comment_mode == "flat"}> <{include file="db:system_comments_flat.html"}> <{elseif $comment_mode == "thread"}> <{include file="db:system_comments_thread.html"}> <{elseif $comment_mode == "nest"}> <{include file="db:system_comments_nest.html"}> <{/if}>
<{include file="db:soapbox8_footer.tpl"}>
