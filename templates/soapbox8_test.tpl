<{include file="db:soapbox8_header.tpl"}>
<div class="outer">
    <div id="pagenav"><{$pagenav}></div>
    <table class="test" cellpadding="0" cellspacing="0" width="100%">
        <tr class="head">
            <th class="center"><{$smarty.const._MD_SOAPBOX8_TEST_ID}></th>
            <th class="center"><{$smarty.const._MD_SOAPBOX8_TEST_TEXT}></th>
            <th class="center"><{$smarty.const._MD_SOAPBOX8_TEST_TEXTAREA}></th>
            <th class="center"><{$smarty.const._MD_SOAPBOX8_TEST_DHTML}></th>
            <th class="center"><{$smarty.const._MD_SOAPBOX8_TEST_CHECKBOX}></th>
            <th class="center"><{$smarty.const._MD_SOAPBOX8_TEST_RADIOYN}></th>
            <th class="center"><{$smarty.const._MD_SOAPBOX8_TEST_SELECTBOX}></th>
            <th class="center"><{$smarty.const._MD_SOAPBOX8_TEST_SELECTUSER}></th>
            <th class="center"><{$smarty.const._MD_SOAPBOX8_TEST_COLORPICKER}></th>
            <th class="center"><{$smarty.const._MD_SOAPBOX8_TEST_UPLOADIMAGE}></th>
            <th class="center"><{$smarty.const._MD_SOAPBOX8_TEST_UPLOADFILE}></th>
            <th class="center"><{$smarty.const._MD_SOAPBOX8_TEST_TEXTDATASELECT}></th>
            <th class="center"><{$smarty.const._MD_SOAPBOX8_TEST_DATETIMESELECT}></th>
            <th class="center"><{$smarty.const._MD_SOAPBOX8_TEST_ARTICLESLINK}></th>
            <th class="center"><{$smarty.const._MD_SOAPBOX8_ACTION}></th>
        </tr>
        <{foreach item=test from=$test}>
            <tr class="<{cycle values='odd, even'}>">
                <td class="center"><{$test.id}></td>
                <td class="center"><{$test.text}></td>
                <td class="center"><{$test.textarea}></td>
                <td class="center"><{$test.dhtml}></td>
                <td class="center"><{$test.checkbox}></td>
                <td class="center"><{$test.radioyn}></td>
                <td class="center"><{$test.selectbox}></td>
                <td class="center"><{$test.selectuser}></td>
                <td class="center"><span style="background-color: <{$test.colorpicker}>;">&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
                <td class="center"><img src="<{$xoops_url}>/uploads/soapbox8/images/<{$test.uploadimage}>" alt="test"></td>
                <td class="center"><{$test.uploadfile}></td>
                <td class="center"><{$test.textdataselect}></td>
                <td class="center"><{$test.datetimeselect}></td>
                <td class="center"><{$test.articleslink}></td>
                <td class="center">
                    <a href="test.php?op=view&id=<{$test.id}>" title="<{$smarty.const._PREVIEW}>"><img src="<{xoModuleIcons16 search.png}>" alt="<{$smarty.const._PREVIEW}>" title="<{$smarty.const._PREVIEW}>"</a> &nbsp;
                    <{if $xoops_isadmin == true}>
                        <a href="admin/test.php?op=edit&id=<{$test.id}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 edit.png}>" alt="<{$smarty.const._EDIT}>" title="<{$smarty.const._EDIT}>"/></a>
                        &nbsp;
                        <a href="admin/test.php?op=delete&id=<{$test.id}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 delete.png}>" alt="<{$smarty.const._DELETE}>" title="<{$smarty.const._DELETE}>"</a>
                    <{/if}>
                </td>
            </tr>
        <{/foreach}>
    </table>
</div>
<{$commentsnav}> <{$lang_notice}>
<{if $comment_mode == "flat"}> <{include file="db:system_comments_flat.html"}> <{elseif $comment_mode == "thread"}> <{include file="db:system_comments_thread.html"}> <{elseif $comment_mode == "nest"}> <{include file="db:system_comments_nest.html"}> <{/if}>
<{include file="db:soapbox8_footer.tpl"}>
