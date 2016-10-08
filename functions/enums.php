<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function getGenders($i)
{
    switch($i)
    {
        case 1:
            return "男";
        case 2:
            return "女";
        case 3:
            return "其他";
        default:
            return "未指定";
    }
}

function getTypeIdCard($i)
{
    switch($i)
    {
        case 1:
            return "居民身份证";
        case 2:
            return "护照";
        case 3:
            return "港澳回乡证";            
        case 4:
            return "台胞证";
        default:
            return "未指定";
    }
}

function getSchoolType($i)
{
    switch($i)
    {
        case 1:
            return "初级中学";
        case 2:
            return "高级中学";
        case 3:
            return "大学";            
        case 4:
            return "研究生院";            
        case 5:
            return "其他";
        default:
            return "未指定";
    }
}

function getSchoolState($i)
{
    switch($i)
    {
        case 1:
            return "等待录取";
        case 2:
            return "社团成员";
        case 3:
            return "已退休"; 
        case 4:
            return "被取消成员资格";  
        case 5:
            return "已自行退出社团";
        default:
            return "未加入";
    }
}