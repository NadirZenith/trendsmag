<?php
foreach (glob('includes/*.php') as $filename)
{
    include_once $filename;
}
