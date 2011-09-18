<?php /* $Id$ $URL$ */
if (!defined('W2P_BASE_DIR')) {
	die('You should not access this file directly.');
}

global $search_string;
global $owner_filter_id;
global $currentTabId;
global $currentTabName;
global $tabbed;
global $type_filter;
global $orderby;
global $orderdir;

// load the company types

$types = w2PgetSysVal('CompanyType');

$company_type_filter = $currentTabId;
$company_type_filter = ($currentTabName == 'Not Applicable') ? 0 : $company_type_filter;
$company_type_filter = ($currentTabName == 'All Companies') ? -1 : $company_type_filter; 

$company = new CCompany();
$allowedCompanies = $company->getAllowedRecords($AppUI->user_id, 'company_id, company_name');

$companyList = $company->getCompanyList($AppUI, $company_type_filter, $search_string, $owner_filter_id, $orderby, $orderdir);
?>
<table width="100%" border="0" cellpadding="2" cellspacing="1" class="tbl">
    <tr>
        <?php
        $fieldList = array();
        $fieldNames = array();
        $fields = w2p_Core_Module::getSettings('companies', 'index_list');
        if (count($fields) > 0) {
            foreach ($fields as $field => $text) {
                $fieldList[] = $field;
                $fieldNames[] = $text;
            }
        } else {
            // TODO: This is only in place to provide an pre-upgrade-safe 
            //   state for versions earlier than v3.0
            //   At some point at/after v4.0, this should be deprecated
            $fieldList = array('company_name', 'countp', 'inactive', 'company_type');
            $fieldNames = array('Company Name', 'Active Projects', 'Archived Projects', 'Type');
        }

        foreach ($fieldNames as $index => $name) {
            ?><th nowrap="nowrap">
                <a href="?m=companies&orderby=<?php echo $fieldList[$index]; ?>" class="hdr">
                    <?php echo $AppUI->_($fieldNames[$index]); ?>
                </a>
            </th><?php
        }
        ?>
    </tr>
    <?php
        if (count($companyList) > 0) {
            foreach ($companyList as $company) {
                echo '<tr>';
                echo '<td>' . (mb_trim($company['company_description']) ? w2PtoolTip($company['company_name'], $company['company_description']) : '') . '<a href="./index.php?m=companies&a=view&company_id=' . $company['company_id'] . '" >' . $company['company_name'] . '</a>' . (mb_trim($company['company_description']) ? w2PendTip() : '') . '</td>';
                echo '<td width="125" align="right" nowrap="nowrap">' . $company['countp'] . '</td>';
                echo '<td width="125" align="right" nowrap="nowrap">' . $company['inactive'] . '</td>';
                echo '<td align="left" nowrap="nowrap">' . $AppUI->_($types[$company['company_type']]) . '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="5">' . $AppUI->_('No companies available') . '</td></tr>';
        }
    ?>
</table>