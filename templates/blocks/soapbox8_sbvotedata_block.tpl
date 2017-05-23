<table class="outer">
    <tr class="head">
        <th><{$smarty.const._MB_SOAPBOX8_RATINGID}></th>
        <th><{$smarty.const._MB_SOAPBOX8_LID}></th>
        <th><{$smarty.const._MB_SOAPBOX8_RATINGUSER}></th>
        <th><{$smarty.const._MB_SOAPBOX8_RATING}></th>
        <th><{$smarty.const._MB_SOAPBOX8_RATINGHOSTNAME}></th>
        <th><{$smarty.const._MB_SOAPBOX8_RATINGTIMESTAMP}></th>
    </tr>
    <{foreachq item=sbvotedata from=$block}>
    <tr class="<{cycle values = 'even,odd'}>">
        <td>
            <{$sbvotedata.ratingid}>
            <{$sbvotedata.lid}>
            <{$sbvotedata.ratinguser}>
            <{$sbvotedata.rating}>
            <{$sbvotedata.ratinghostname}>
            <{$sbvotedata.ratingtimestamp}>
        </td>
    </tr>
    <{/foreach}>
</table>
