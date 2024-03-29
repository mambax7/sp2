<table class="outer">
    <tr class="head">
        <th><{$smarty.const._MB_SOAPBOX8_ARTICLEID}></th>
        <th><{$smarty.const._MB_SOAPBOX8_COLUMNID}></th>
        <th><{$smarty.const._MB_SOAPBOX8_HEADLINE}></th>
        <th><{$smarty.const._MB_SOAPBOX8_LEAD}></th>
        <th><{$smarty.const._MB_SOAPBOX8_BODYTEXT}></th>
        <th><{$smarty.const._MB_SOAPBOX8_TEASER}></th>
        <th><{$smarty.const._MB_SOAPBOX8_UID}></th>
        <th><{$smarty.const._MB_SOAPBOX8_SUBMIT}></th>
        <th><{$smarty.const._MB_SOAPBOX8_DATESUB}></th>
        <th><{$smarty.const._MB_SOAPBOX8_COUNTER}></th>
        <th><{$smarty.const._MB_SOAPBOX8_WEIGHT}></th>
        <th><{$smarty.const._MB_SOAPBOX8_HTML}></th>
        <th><{$smarty.const._MB_SOAPBOX8_SMILEY}></th>
        <th><{$smarty.const._MB_SOAPBOX8_XCODES}></th>
        <th><{$smarty.const._MB_SOAPBOX8_BREAKS}></th>
        <th><{$smarty.const._MB_SOAPBOX8_BLOCK}></th>
        <th><{$smarty.const._MB_SOAPBOX8_ARTIMAGE}></th>
        <th><{$smarty.const._MB_SOAPBOX8_VOTES}></th>
        <th><{$smarty.const._MB_SOAPBOX8_RATING}></th>
        <th><{$smarty.const._MB_SOAPBOX8_COMMENTABLE}></th>
        <th><{$smarty.const._MB_SOAPBOX8_OFFLINE}></th>
        <th><{$smarty.const._MB_SOAPBOX8_NOTIFYPUB}></th>
    </tr>
    <{foreachq item=sbarticles from=$block}>
    <tr class="<{cycle values = 'even,odd'}>">
        <td>
            <{$sbarticles.articleID}>
            <{$sbarticles.columnID}>
            <{$sbarticles.headline}>
            <{$sbarticles.lead}>
            <{$sbarticles.bodytext}>
            <{$sbarticles.teaser}>
            <{$sbarticles.uid}>
            <{$sbarticles.submit}>
            <{$sbarticles.datesub}>
            <{$sbarticles.counter}>
            <{$sbarticles.weight}>
            <{$sbarticles.html}>
            <{$sbarticles.smiley}>
            <{$sbarticles.xcodes}>
            <{$sbarticles.breaks}>
            <{$sbarticles.block}>
            <{$sbarticles.artimage}>
            <{$sbarticles.votes}>
            <{$sbarticles.rating}>
            <{$sbarticles.commentable}>
            <{$sbarticles.offline}>
            <{$sbarticles.notifypub}>
        </td>
    </tr>
    <{/foreach}>
</table>
