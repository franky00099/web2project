<form name="changeclient" action="?m=<?php echo $m; ?>" method="post" accept-charset="utf-8" class="form-horizontal">
	<input type="hidden" name="dosql" value="do_company_aed" />
	<input type="hidden" name="company_id" value="<?php echo $company_id; ?>" />

	<table cellspacing="1" cellpadding="1" border="0" width="100%" class="std addedit">
		<tr>
			<td width="50%" style="vertical-align: top">
				<table cellspacing="1" cellpadding="2" width="100%" class="well">
					<tr>
						<td align="right"><?php echo $AppUI->_('Company Name'); ?>:</td>
						<td>
							<input type="text" class="text" name="company_name" value="<?php echo w2PformSafe($company->company_name); ?>" size="50" maxlength="255" /> (<?php echo $AppUI->_('required'); ?>)
						</td>
					</tr>
					<tr>
						<td align="right"><?php echo $AppUI->_('Email'); ?>:</td>
						<td>
							<input type="text" class="text" name="company_email" value="<?php echo w2PformSafe($company->company_email); ?>" size="30" maxlength="255" />
						</td>
					</tr>
					<tr>
						<td align="right"><?php echo $AppUI->_('Phone'); ?>:</td>
						<td>
							<input type="text" class="text" name="company_phone1" value="<?php echo w2PformSafe($company->company_phone1); ?>" maxlength="30" />
						</td>
					</tr>
					<tr>
						<td align="right"><?php echo $AppUI->_('Phone'); ?>2:</td>
						<td>
							<input type="text" class="text" name="company_phone2" value="<?php echo w2PformSafe($company->company_phone2); ?>" maxlength="50" />
						</td>
					</tr>
					<tr>
                        <td align="right">
                            URL http://<a name="x"></a></td><td><input type="text" class="text" value="<?php echo w2PformSafe($company->company_primary_url); ?>" name="company_primary_url" size="50" maxlength="255" />
                            <a href="javascript: void(0);" onclick="testURL('CompanyURLOne')">[<?php echo $AppUI->_('test'); ?>]</a>
                        </td>
					</tr>
					<tr>
						<td align="right" valign="top"><?php echo $AppUI->_('Description'); ?>:</td>
						<td align="left">
							<textarea name="company_description"><?php echo $company->company_description; ?></textarea>
						</td>
					</tr>
                    <tr>
                        <td align="left" colspan="2">
                            <?php
                            $custom_fields = new w2p_Core_CustomFields($m, $a, $company->company_id, "edit");
                            $custom_fields->printHTML();
                            ?>
                        </td>
                    </tr>
                </table>
            </td>
            <td width="50%" style="vertical-align: top">
                <table cellspacing="1" cellpadding="2" width="100%" class="well">
					<tr>
						<td colspan="2" align="center">
							<?php echo $AppUI->_('Address'); ?>
						</td>
					</tr>
					<tr>
						<td align="right"><?php echo $AppUI->_('Address'); ?>1:</td>
						<td><input type="text" class="text" name="company_address1" value="<?php echo w2PformSafe($company->company_address1); ?>" size="50" maxlength="255" /></td>
					</tr>
					<tr>
						<td align="right"><?php echo $AppUI->_('Address'); ?>2:</td>
						<td><input type="text" class="text" name="company_address2" value="<?php echo w2PformSafe($company->company_address2); ?>" size="50" maxlength="255" /></td>
					</tr>
					<tr>
						<td align="right"><?php echo $AppUI->_('City'); ?>:</td>
						<td><input type="text" class="text" name="company_city" value="<?php echo w2PformSafe($company->company_city); ?>" size="50" maxlength="50" /></td>
					</tr>
					<tr>
						<td align="right"><?php echo $AppUI->_('State'); ?>:</td>
						<td><input type="text" class="text" name="company_state" value="<?php echo w2PformSafe($company->company_state); ?>" maxlength="50" /></td>
					</tr>
					<tr>
						<td align="right"><?php echo $AppUI->_('Zip'); ?>:</td>
						<td><input type="text" class="text" name="company_zip" value="<?php echo w2PformSafe($company->company_zip); ?>" maxlength="15" /></td>
					</tr>
					<tr>
						<td align="right"><?php echo $AppUI->_('Country'); ?>:</td>
						<td>
							<?php
								echo arraySelect($countries, 'company_country', 'size="1" class="text"', $company->company_country ? $company->company_country : 0);
							?>
						</td>
					</tr>
					<tr>
                        <td align="right"><?php echo $AppUI->_('Fax'); ?>:</td>
                        <td>
                            <input type="text" class="text" name="company_fax" value="<?php echo w2PformSafe($company->company_fax); ?>" maxlength="30" />
                        </td>
                    </tr>
					<tr>
						<td align="right"><?php echo $AppUI->_('Company Owner'); ?>:</td>
						<td>
							<?php
								$perms = &$AppUI->acl();
                                $users = $perms->getPermittedUsers('companies');
								echo arraySelect($users, 'company_owner', 'size="1" class="text"', $company->company_owner ? $company->company_owner : $AppUI->user_id);
							?>
						</td>
					</tr>
					<tr>
						<td align="right"><?php echo $AppUI->_('Type'); ?>:</td>
						<td>
							<?php
								echo arraySelect($types, 'company_type', 'size="1" class="text"', $company->company_type, true);
							?>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td><input type="button" value="<?php echo $AppUI->_('back'); ?>" class="button btn btn-danger" onclick="javascript:history.back(-1);" /></td>
			<td align="right"><input type="button" value="<?php echo $AppUI->_('submit'); ?>" class="button btn btn-primary" onclick="submitIt()" /></td>
		</tr>
	</table>
</form>