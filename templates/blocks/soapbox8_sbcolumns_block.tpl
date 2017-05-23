<table class="outer">
    <tr class="head">
        <th><{$smarty.const._MB_SOAPBOX8_COLUMNID}></th>
        <th><{$smarty.const._MB_SOAPBOX8_AUTHOR}></th>
        <th><{$smarty.const._MB_SOAPBOX8_NAME}></th>
        <th><{$smarty.const._MB_SOAPBOX8_DESCRIPTION}></th>
        <th><{$smarty.const._MB_SOAPBOX8_TOTAL}></th>
        <th><{$smarty.const._MB_SOAPBOX8_WEIGHT}></th>
        <th><{$smarty.const._MB_SOAPBOX8_COLIMAGE}></th>
        <th><{$smarty.const._MB_SOAPBOX8_CREATED}></th>
    </tr>
    <{foreachq item=sbcolumns from=$block}>
    <tr class="<{cycle values = 'even,odd'}>">
        <td>
            <{$sbcolumns.columnID}>
            <{$sbcolumns.author}>
            <{$sbcolumns.name}>
            <{$sbcolumns.description}>
            <{$sbcolumns.total}>
            <{$sbcolumns.weight}>
            <{$sbcolumns.colimage}>
            <{$sbcolumns.created}>
        </td>
    </tr>
    <{/foreach}>
</table>
