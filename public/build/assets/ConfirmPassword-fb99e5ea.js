import{T as m,d,o as c,e as u,b as a,u as e,w as r,F as p,Z as f,a as o,n as _,g as w,i as g}from"./app-601f1713.js";import{A as b}from"./AuthenticationCard-66081668.js";import{_ as h}from"./AuthenticationCardLogo-60a6340c.js";import{_ as x,a as y}from"./TextInput-c8135674.js";import{_ as v}from"./InputLabel-947ed4b8.js";import{_ as V}from"./PrimaryButton-178f41a5.js";import"./_plugin-vue_export-helper-c27b6911.js";const k=o("div",{class:"mb-4 text-sm text-gray-600 dark:text-gray-400"}," This is a secure area of the application. Please confirm your password before continuing. ",-1),C=["onSubmit"],$={class:"flex justify-end mt-4"},q={__name:"ConfirmPassword",setup(A){const s=m({password:""}),t=d(null),n=()=>{s.post(route("password.confirm"),{onFinish:()=>{s.reset(),t.value.focus()}})};return(B,i)=>(c(),u(p,null,[a(e(f),{title:"Secure Area"}),a(b,null,{logo:r(()=>[a(h)]),default:r(()=>[k,o("form",{onSubmit:g(n,["prevent"])},[o("div",null,[a(v,{for:"password",value:"Password"}),a(x,{id:"password",ref_key:"passwordInput",ref:t,modelValue:e(s).password,"onUpdate:modelValue":i[0]||(i[0]=l=>e(s).password=l),type:"password",class:"mt-1 block w-full",required:"",autocomplete:"current-password",autofocus:""},null,8,["modelValue"]),a(y,{class:"mt-2",message:e(s).errors.password},null,8,["message"])]),o("div",$,[a(V,{class:_(["ms-4",{"opacity-25":e(s).processing}]),disabled:e(s).processing},{default:r(()=>[w(" Confirm ")]),_:1},8,["class","disabled"])])],40,C)]),_:1})],64))}};export{q as default};
