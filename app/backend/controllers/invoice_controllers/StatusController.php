<?php

$statuses = new JobStatus();

$statusNames = json_decode($statuses -> getStatuses(), true);
