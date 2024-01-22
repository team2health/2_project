<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        '/namechk',
        '/myhashdelete',
        '/partselect',
        '/allhashtag',
        '/addfavoritehashtag',
        '/symptomselect',
        '/useraddress',
        '/comment',
        '/selectaddtag',
        '/idchk',
        '/namechange',
        '/daytimeline',
        '/userimgremove',
        '/boardcategory/{categoryId}',
        '/recorddelete',
        '/nextboard',
        '/favoritenextboard',
        '/mypagecommentplus',
        '/mypageboardplus',
        '/deleteacountchk',
        '/changpasswordchk',
        '/hashtagsearch',
        '/adminlogout',
        '/admin/contentssort',
        '/admin/commentsearch',
        '/admin/hashtaginsert',
        '/admin/pandemicinsert',
        '/admin/adminregist',
        '/emailchkgo',
        '/emailchkset',
        '/admin/userdeclaration',
        '/hashtagcheck',
        '/admin/deletedcontentsort',
    ];
}
