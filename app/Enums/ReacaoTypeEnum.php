<?php

namespace App\Enums;

enum ReacaoTypeEnum:string {
    case Post = 'post';
    case Comentario = 'comentario';
}