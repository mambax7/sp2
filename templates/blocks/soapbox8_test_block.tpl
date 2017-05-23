<table class="outer">
    <tr class="head">
        <th><{$smarty.const._MB_SOAPBOX8_ID}></th>
        <th><{$smarty.const._MB_SOAPBOX8_TEXT}></th>
        <th><{$smarty.const._MB_SOAPBOX8_TEXTAREA}></th>
        <th><{$smarty.const._MB_SOAPBOX8_DHTML}></th>
        <th><{$smarty.const._MB_SOAPBOX8_CHECKBOX}></th>
        <th><{$smarty.const._MB_SOAPBOX8_RADIOYN}></th>
        <th><{$smarty.const._MB_SOAPBOX8_SELECTBOX}></th>
        <th><{$smarty.const._MB_SOAPBOX8_SELECTUSER}></th>
        <th><{$smarty.const._MB_SOAPBOX8_COLORPICKER}></th>
        <th><{$smarty.const._MB_SOAPBOX8_UPLOADIMAGE}></th>
        <th><{$smarty.const._MB_SOAPBOX8_UPLOADFILE}></th>
        <th><{$smarty.const._MB_SOAPBOX8_TEXTDATASELECT}></th>
        <th><{$smarty.const._MB_SOAPBOX8_DATETIMESELECT}></th>
        <th><{$smarty.const._MB_SOAPBOX8_ARTICLESLINK}></th>
    </tr>
    <{foreachq item=test from=$block}>
    <tr class="<{cycle values = 'even,odd'}>">
        <td>
            <{$test.id}>
            <{$test.text}>
            <{$test.textarea}>
            <{$test.dhtml}>
            <{$test.checkbox}>
            <{$test.radioyn}>
            <{$test.selectbox}>
            <{$test.selectuser}>
            <{$test.colorpicker}>
            <{$test.uploadimage}>
            <{$test.uploadfile}>
            <{$test.textdataselect}>
            <{$test.datetimeselect}>
            <{$test.articleslink}>
        </td>
    </tr>
    <{/foreach}>
</table>
