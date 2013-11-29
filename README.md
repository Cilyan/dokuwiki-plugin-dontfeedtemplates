Don't Feed Templates Plugin for DokuWiki
========================================

This plugin works together with TemplatePageName. By default, DokuWiki does not
include pages with name starting by ``.``, ``-`` or ``_`` in feeds, which is
enough to have templates hidden when listing namespaces. If you use the plugin
TemplatePageName to change the default template names, chances are high that
you will not start you template with one of these three characters to make your
template editable online. In that case, you will have the template page listed
in your feeds.

This plugin makes sure these template pages do not appear in namespace listing
feeds.

By default, the plugin will get the template page names from the 
TemplatePageName plugin configuration, so you don't need to configure it twice.
If you do not use TemplatePageName but still want to filter out some
special template files (or if you use another plugin to achieve the same goal
as TemplatePageName), you may still use the plugin. You need to activate the
``always`` option that forces the plugin to activate, and you will also need to
specify yourself the template page names for the two kinds of DokuWiki's
templates (current namespace, or current and below namespaces).

Installation
------------

If you install this plugin manually, make sure it is installed in 
``lib/plugins/dontfeedtemplates/``. If the folder is called differently the 
plugin will not work!

Please refer to http://www.dokuwiki.org/plugins for additional info
on how to install plugins in DokuWiki.

----

Copyright (C) Cilyan Olowen <gaknar@gmail.com>

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; version 2 of the License

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

See the COPYING file in your DokuWiki folder for details
