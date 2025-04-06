<?php
namespace app\Consts;

// usersで使う定数
class RecipeConst
{
  public const INGREDIENT_TYPE = [
    1 => 'お菓子',
    2 => 'パン',
    3 => 'サラダ',
    4 => '魚介類',
    5 => '肉料理',
    6 => 'ご飯',
    7 => '麺類',
    8 => 'スープ',
];
public const TYPE_COLOR = [
    1 => ['お菓子','pink' ],
    2 => ['パン','orange' ],
    3 => ['サラダ','green' ],
    4 => ['魚介類','skyblue' ],
    5 => ['肉料理','brown' ],
    6 => ['ご飯','lightyellow' ],
    7 => ['麺類','lightyellow' ],
    8 => ['スープ','lightgreen' ],
];
}