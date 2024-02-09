<?php

function dateToFormatDDDMMMYYYY($date): string
{
    return date('D, d M Y', strtotime($date));
}
