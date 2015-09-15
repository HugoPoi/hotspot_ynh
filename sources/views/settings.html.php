<!--
  Wifi Hotspot app for YunoHost 
  Copyright (C) 2015 Julien Vaubourg <julien@vaubourg.com>
  Contribute at https://github.com/labriqueinternet/hotspot_ynh
  
  This program is free software: you can redistribute it and/or modify
  it under the terms of the GNU Affero General Public License as published by
  the Free Software Foundation, either version 3 of the License, or
  (at your option) any later version.
  
  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU Affero General Public License for more details.
  
  You should have received a copy of the GNU Affero General Public License
  along with this program.  If not, see <http://www.gnu.org/licenses/>.
-->

<div id="wifiparty_screen">
  <div id="wifiparty_ssid_part">
    <div class="btn-group" role="group">
      <button type="button" class="btn btn-default" id="wifiparty_close"><span class="glyphicon glyphicon-eye-close"></span></button>
      <button type="button" class="btn btn-default" id="wifiparty_zoomin_ssid"><span class="glyphicon glyphicon-zoom-in"></span></button>
      <button type="button" class="btn btn-default" id="wifiparty_zoomout_ssid"><span class="glyphicon glyphicon-zoom-out"></span></button>
    </div>
  
    <span id="wifiparty_ssid"><span class="glyphicon glyphicon-signal"></span> <span></span></span>
  </div>
  
  <div class="btn-group" role="group">
    <button type="button" class="btn btn-default" id="wifiparty_zoomin_passphrase"><span class="glyphicon glyphicon-zoom-in"></span></button>
    <button type="button" class="btn btn-default" id="wifiparty_zoomout_passphrase"><span class="glyphicon glyphicon-zoom-out"></span></button>
  </div>
</div>

<h2><?= _("Wifi Hotspot Configuration") ?></h2>
<?php if($faststatus): ?>
  <span class="label label-success" data-toggle="tooltip" data-title="<?= _('This is a fast status. Click on More details to show the complete status.') ?>"><?= _('Running') ?></span>
<?php else: ?>
  <span class="label label-danger" data-toggle="tooltip" data-title="<?= _('This is a fast status. Click on More details to show the complete status.') ?>"><?= _('Not Running') ?></span>
<?php endif; ?>

 &nbsp; <img src="public/img/loading.gif" id="status-loading" alt="Loading..." /><a href="#" id="statusbtn" data-toggle="tooltip" data-title="<?= _('Loading complete status may take a few minutes. Be patient.') ?>"><?= _('More details') ?></a>

<div id="status" class="alert alert-dismissible alert-info fade in" style="margin-top: 10px" role="alert">
  <button type="button" class="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <div id="status-text"></div>
</div>

<hr />

<div class="row">
  <div class="col-sm-offset-2 col-sm-8">
    <form method="post" enctype="multipart/form-data" action="?/settings" class="form-horizontal" role="form" id="form">
      <input type="hidden" name="_method" value="put" />

      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"><?= _("Service") ?></h3>
        </div>

        <div style="padding: 14px 14px 0 10px">
          <div class="form-group">
            <label for="service_enabled" class="col-sm-3 control-label"><?= _('Hotspot Enabled') ?></label>
            <div class="col-sm-9 input-group-btn">
              <div class="input-group">
                <input type="checkbox" class="form-control switch" name="service_enabled" id="service_enabled" value="1" <?= $service_enabled == 1 ? 'checked="checked"' : '' ?> />
              </div>
            </div>
          </div>
          <div class="form-group">
            <?php if(empty($wifi_device)): ?>
              <div class="alert alert-dismissible alert-warning fade in" style="margin: 2px 16px 17px" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <strong><?= _('Notice') ?>:</strong> <?= str_replace('<LINK:RELOAD>', '<a href="javascript:location.reload()" class="alert-link">', str_replace('</LINK:RELOAD>', '</a>', _("You need to select a wifi antenna interface. If you use a wifi USB dongle and that this one is not listed here, try to unplug and replug it, then <LINK:RELOAD>reload</LINK:RELOAD> this page."))) ?>
              </div>
            <?php endif; ?>

            <label for="wifi_device" class="col-sm-3 control-label"><?= _('Device') ?></label>
            <div class="col-sm-9 input-group-btn">
              <div class="input-group">
                  <input type="text" name="wifi_device" id="wifi_device" value="<?= $wifi_device ?>" style="display: none" />
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><?= empty($wifi_device) ? '<em>'._("None").'</em>' : $wifi_device ?> <span class="caret"></span></button>
                  <ul class="dropdown-menu dropdown-menu-left" id="devlist" role="menu">
                    <?= $wifi_device_list ?>
                  </ul>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label"><?= _('Channel') ?></label>
            <div class="col-sm-9 input-group-btn">
              <div class="input-group dropdownmenu">
                  <input type="text" name="wifi_channel" value="<?= $wifi_channel ?>" style="display: none" />
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><?= $wifi_channel ?> <span class="caret"></span></button>
                  <ul class="dropdown-menu dropdown-menu-left" role="menu">
                    <li <?= $wifi_channel == 1 ? 'class="active"' : '' ?>><a href="javascript:;">1</a></li>
                    <li <?= $wifi_channel == 2 ? 'class="active"' : '' ?>><a href="javascript:;">2</a></li>
                    <li <?= $wifi_channel == 3 ? 'class="active"' : '' ?>><a href="javascript:;">3</a></li>
                    <li <?= $wifi_channel == 4 ? 'class="active"' : '' ?>><a href="javascript:;">4</a></li>
                    <li <?= $wifi_channel == 5 ? 'class="active"' : '' ?>><a href="javascript:;">5</a></li>
                    <li <?= $wifi_channel == 6 ? 'class="active"' : '' ?>><a href="javascript:;">6</a></li>
                    <li <?= $wifi_channel == 7 ? 'class="active"' : '' ?>><a href="javascript:;">7</a></li>
                    <li <?= $wifi_channel == 8 ? 'class="active"' : '' ?>><a href="javascript:;">8</a></li>
                    <li <?= $wifi_channel == 9 ? 'class="active"' : '' ?>><a href="javascript:;">9</a></li>
                    <li <?= $wifi_channel == 10 ? 'class="active"' : '' ?>><a href="javascript:;">10</a></li>
                    <li <?= $wifi_channel == 11 ? 'class="active"' : '' ?>><a href="javascript:;">11</a></li>
                  </ul>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div id="ssids">
      <?php foreach($ssids as $ssid): ?>
        <?php set('ssid', $ssid) ?>
        <?= partial('_ssid.html.php') ?>
      <?php endforeach; ?>
      </div>

      <button id="newssid" type="button" class="btn btn-success enabled" <?= $service_enabled == 0 ? 'style="display: none"' : '' ?>><?= _("Add a hotspot") ?> <span class="badge">0</span></button>

      <div class="form-group">
        <div style="text-align: center">
<?php if($is_connected_through_hotspot): ?>
          <div class="alert alert-dismissible alert-warning fade in" role="alert" id="saveconfirmation">
            <strong><?= _('Notice') ?>:</strong> <?= _("You are currently connected through the wifi hotspot. Please, confirm the reloading, wait for the wifi disconnect/reconnect and go back here to check that everything is okay.") ?>
            <div id="confirm">
              <button type="submit" class="btn btn-default" data-toggle="tooltip" id="save" data-title="<?= _('Reloading may take a few minutes. Be patient.') ?>"><?= _('Confirm') ?></button> <img src="public/img/loading.gif" id="save-loading" alt="Loading..." />
            </div>
          </div>

          <button type="button" class="btn btn-default" id="saveconfirm"><?= _('Save and reload') ?></button>
<?php else: ?>
          <button type="submit" class="btn btn-default" data-toggle="tooltip" id="save" data-title="<?= _('Reloading may take a few minutes. Be patient.') ?>"><?= _('Save and reload') ?></button> <img src="public/img/loading.gif" id="save-loading" alt="Loading..." />
<?php endif; ?>
        </div>
      </div>
    </form>
  </div>
</div>
