# content_project.fcgi is configured to live in projects/content_project/deploy.

import os
import sys

from os.path import abspath, dirname, join
from site import addsitedir

sys.path.insert(0, abspath(join(dirname(__file__), "../../")))

from django.conf import settings
os.environ["DJANGO_SETTINGS_MODULE"] = "content_project.settings"

path = addsitedir(join(settings.PINAX_ROOT, "libs/external_libs"), set())
if path:
    sys.path = list(path) + sys.path

sys.path.insert(0, join(settings.PINAX_ROOT, "apps/external_apps"))
sys.path.insert(0, join(settings.PINAX_ROOT, "apps/local_apps"))
sys.path.insert(0, join(settings.PROJECT_ROOT, "apps"))

from django.core.servers.fastcgi import runfastcgi
runfastcgi(method="threaded", daemonize="false")