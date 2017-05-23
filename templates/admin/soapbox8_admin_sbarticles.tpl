<{if $sbarticlesRows > 0}>
    <div class="outer">
        <form name="select" action="sbarticles.php?op=" method="POST"
              onsubmit="if(window.document.select.op.value =='') {return false;} else if (window.document.select.op.value =='delete') {return deleteSubmitValid('sbarticlesId[]');} else if (isOneChecked('sbarticlesId[]')) {return true;} else {alert('<{$smarty.const._AM_SBARTICLES_SELECTED_ERROR}>'); return false;}">
            <input type="hidden" name="confirm" value="1"/>
            <div class="floatleft">
                <select name="op">
                    <option value=""><{$smarty.const._AM_SOAPBOX8_SELECT}></option>
                    <option value="delete"><{$smarty.const._AM_SOAPBOX8_SELECTED_DELETE}></option>
                </select>
                <input id="submitUp" class="formButton" type="submit" name="submitselect" value="<{$smarty.const._SUBMIT}>" title="<{$smarty.const._SUBMIT}>"/>
            </div>
            <div class="floatcenter0">
                <div id="pagenav"><{$pagenav}></div>
            </div>


            <table class="$sbarticles" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <th align="center" width="5%"><input name="allbox" title="allbox" id="allbox" onclick="xoopsCheckAll('select', 'allbox');" type="checkbox" title="Check All" value="Check All"/></th>
                    <th class="center"><{$selectorarticleID}></th>
                    <th class="center"><{$selectorcolumnID}></th>
                    <th class="center"><{$selectorheadline}></th>
                    <th class="center"><{$selectorlead}></th>
                    <th class="center"><{$selectorbodytext}></th>
                    <th class="center"><{$selectorteaser}></th>
                    <th class="center"><{$selectoruid}></th>
                    <th class="center"><{$selectorsubmit}></th>
                    <th class="center"><{$selectordatesub}></th>
                    <th class="center"><{$selectorcounter}></th>
                    <th class="center"><{$selectorweight}></th>
                    <th class="center"><{$selectorhtml}></th>
                    <th class="center"><{$selectorsmiley}></th>
                    <th class="center"><{$selectorxcodes}></th>
                    <th class="center"><{$selectorbreaks}></th>
                    <th class="center"><{$selectorblock}></th>
                    <th class="center"><{$selectorartimage}></th>
                    <th class="center"><{$selectorvotes}></th>
                    <th class="center"><{$selectorrating}></th>
                    <th class="center"><{$selectorcommentable}></th>
                    <th class="center"><{$selectoroffline}></th>
                    <th class="center"><{$selectornotifypub}></th>

                    <th class="center width5"><{$smarty.const._AM_SOAPBOX8_FORM_ACTION}></th>
                </tr>
                <{foreach item=sbarticlesArray from=$sbarticlesArrays}>
                    <tr class="<{cycle values="odd,even"}>">

                        <td align="center" style="vertical-align:middle;"><input type="checkbox" name="sbarticles_id[]" title="sbarticles_id[]" id="sbarticles_id[]" value="<{$sbarticlesArray.sbarticles_id}>"/></td>
                        <td class='center'><{$sbarticlesArray.articleID}></td>
                        <td class='center'><{$sbarticlesArray.columnID}></td>
                        <td class='center'><{$sbarticlesArray.headline}></td>
                        <td class='center'><{$sbarticlesArray.lead}></td>
                        <td class='center'><{$sbarticlesArray.bodytext}></td>
                        <td class='center'><{$sbarticlesArray.teaser}></td>
                        <td class='center'><{$sbarticlesArray.uid}></td>
                        <td class='center'><{$sbarticlesArray.submit}></td>
                        <td class='center'><{$sbarticlesArray.datesub}></td>
                        <td class='center'><{$sbarticlesArray.counter}></td>
                        <td class='center'><{$sbarticlesArray.weight}></td>
                        <td class='center'><{$sbarticlesArray.html}></td>
                        <td class='center'><{$sbarticlesArray.smiley}></td>
                        <td class='center'><{$sbarticlesArray.xcodes}></td>
                        <td class='center'><{$sbarticlesArray.breaks}></td>
                        <td class='center'><{$sbarticlesArray.block}></td>
                        <td class='center'><{$sbarticlesArray.artimage}></td>
                        <td class='center'><{$sbarticlesArray.votes}></td>
                        <td class='center'><{$sbarticlesArray.rating}></td>
                        <td class='center'><{$sbarticlesArray.commentable}></td>
                        <td class='center'><{$sbarticlesArray.offline}></td>
                        <td class='center'><{$sbarticlesArray.notifypub}></td>


                        <td class="center width5"><{$sbarticlesArray.edit_delete}></td>
                    </tr>
                <{/foreach}>
            </table>
            <br>
            <br>
            <{else}>
            <table width="100%" cellspacing="1" class="outer">
                <tr>

                    <th align="center" width="5%"><input name="allbox" title="allbox" id="allbox" onclick="xoopsCheckAll('select', 'allbox');" type="checkbox" title="Check All" value="Check All"/></th>
                    <th class="center"><{$selectorarticleID}></th>
                    <th class="center"><{$selectorcolumnID}></th>
                    <th class="center"><{$selectorheadline}></th>
                    <th class="center"><{$selectorlead}></th>
                    <th class="center"><{$selectorbodytext}></th>
                    <th class="center"><{$selectorteaser}></th>
                    <th class="center"><{$selectoruid}></th>
                    <th class="center"><{$selectorsubmit}></th>
                    <th class="center"><{$selectordatesub}></th>
                    <th class="center"><{$selectorcounter}></th>
                    <th class="center"><{$selectorweight}></th>
                    <th class="center"><{$selectorhtml}></th>
                    <th class="center"><{$selectorsmiley}></th>
                    <th class="center"><{$selectorxcodes}></th>
                    <th class="center"><{$selectorbreaks}></th>
                    <th class="center"><{$selectorblock}></th>
                    <th class="center"><{$selectorartimage}></th>
                    <th class="center"><{$selectorvotes}></th>
                    <th class="center"><{$selectorrating}></th>
                    <th class="center"><{$selectorcommentable}></th>
                    <th class="center"><{$selectoroffline}></th>
                    <th class="center"><{$selectornotifypub}></th>

                    <th class="center width5"><{$smarty.const._AM_SOAPBOX8_FORM_ACTION}></th>
                </tr>
                <tr>
                    <td class="errorMsg" colspan="11">There are no $sbarticles</td>
                </tr>
            </table>
    </div>
    <br>
    <br>
<{/if}>
