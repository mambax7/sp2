<{if $sbvotedataRows > 0}>
    <div class="outer">
        <form name="select" action="sbvotedata.php?op=" method="POST"
              onsubmit="if(window.document.select.op.value =='') {return false;} else if (window.document.select.op.value =='delete') {return deleteSubmitValid('sbvotedataId[]');} else if (isOneChecked('sbvotedataId[]')) {return true;} else {alert('<{$smarty.const._AM_SBVOTEDATA_SELECTED_ERROR}>'); return false;}">
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


            <table class="$sbvotedata" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <th align="center" width="5%"><input name="allbox" title="allbox" id="allbox" onclick="xoopsCheckAll('select', 'allbox');" type="checkbox" title="Check All" value="Check All"/></th>
                    <th class="center"><{$selectorratingid}></th>
                    <th class="center"><{$selectorlid}></th>
                    <th class="center"><{$selectorratinguser}></th>
                    <th class="center"><{$selectorrating}></th>
                    <th class="center"><{$selectorratinghostname}></th>
                    <th class="center"><{$selectorratingtimestamp}></th>

                    <th class="center width5"><{$smarty.const._AM_SOAPBOX8_FORM_ACTION}></th>
                </tr>
                <{foreach item=sbvotedataArray from=$sbvotedataArrays}>
                    <tr class="<{cycle values="odd,even"}>">

                        <td align="center" style="vertical-align:middle;"><input type="checkbox" name="sbvotedata_id[]" title="sbvotedata_id[]" id="sbvotedata_id[]" value="<{$sbvotedataArray.sbvotedata_id}>"/></td>
                        <td class='center'><{$sbvotedataArray.ratingid}></td>
                        <td class='center'><{$sbvotedataArray.lid}></td>
                        <td class='center'><{$sbvotedataArray.ratinguser}></td>
                        <td class='center'><{$sbvotedataArray.rating}></td>
                        <td class='center'><{$sbvotedataArray.ratinghostname}></td>
                        <td class='center'><{$sbvotedataArray.ratingtimestamp}></td>


                        <td class="center width5"><{$sbvotedataArray.edit_delete}></td>
                    </tr>
                <{/foreach}>
            </table>
            <br>
            <br>
            <{else}>
            <table width="100%" cellspacing="1" class="outer">
                <tr>

                    <th align="center" width="5%"><input name="allbox" title="allbox" id="allbox" onclick="xoopsCheckAll('select', 'allbox');" type="checkbox" title="Check All" value="Check All"/></th>
                    <th class="center"><{$selectorratingid}></th>
                    <th class="center"><{$selectorlid}></th>
                    <th class="center"><{$selectorratinguser}></th>
                    <th class="center"><{$selectorrating}></th>
                    <th class="center"><{$selectorratinghostname}></th>
                    <th class="center"><{$selectorratingtimestamp}></th>

                    <th class="center width5"><{$smarty.const._AM_SOAPBOX8_FORM_ACTION}></th>
                </tr>
                <tr>
                    <td class="errorMsg" colspan="11">There are no $sbvotedata</td>
                </tr>
            </table>
    </div>
    <br>
    <br>
<{/if}>
