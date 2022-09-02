const express=require('express');
const mangoose=require('mangoose');
const app= express();
const ejs=require('ejs');

app.set('view engine','ejs');
mangoose.connect('mongodb://localhost:27017/?readPreference=primary&appname=MongoDB%20Compass&ssl=false');

app.get('/',(req,res)=>{
    res.render('bank_sys');
})

app.listen(4000,function()
{
    console.log('server is running');
})
