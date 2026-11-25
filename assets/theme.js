'use strict';
document.documentElement.classList.add('js');
const toggle=document.querySelector('.nav-toggle');
if(toggle){
 const nav=document.getElementById('left-nav');
 const mobile=matchMedia('(max-width:900px)');
 const backdrop=document.createElement('div');backdrop.className='nav-backdrop';backdrop.setAttribute('aria-hidden','true');document.body.append(backdrop);
 const close=document.createElement('button');close.className='nav-close';close.type='button';close.textContent='× 閉じる';close.setAttribute('aria-label','メニューを閉じる');nav.prepend(close);
 const outside=[...document.querySelectorAll('.site-header,.breadcrumbs,.main-content,.right-sidebar,.site-footer')];
 let previousFocus=null;
 const storageKey="gsw.desktopNavOpen";
 let desktopOpen=true;
 try{const saved=localStorage.getItem(storageKey);if(saved==="false"||saved==="true")desktopOpen=saved==="true";}catch(error){/* Storage may be disabled; navigation still works. */}
 function setOpen(open,restore=true){
  open=Boolean(open);
  if(!mobile.matches){
   desktopOpen=open;
   toggle.setAttribute('aria-expanded',String(open));toggle.setAttribute('aria-label',open?'メニューを閉じる':'メニューを開く');
   document.body.classList.toggle('desktop-nav-closed',!open);document.body.classList.remove('nav-open');
   nav.classList.remove('is-open');nav.inert=!open;outside.forEach(el=>{el.inert=false;});
   ['role','aria-label','aria-modal','aria-hidden'].forEach(attr=>nav.removeAttribute(attr));
   if(!open)nav.setAttribute('aria-hidden','true');
   previousFocus=null;return;
  }
  document.body.classList.remove('desktop-nav-closed');
  toggle.setAttribute('aria-label',open?'メニューを閉じる':'メニューを開く');
  if(open)previousFocus=document.activeElement;
  toggle.setAttribute('aria-expanded',String(open));nav.classList.toggle('is-open',open);document.body.classList.toggle('nav-open',open);
  outside.forEach(el=>{el.inert=open;});
  nav.inert=mobile.matches&&!open;
  if(mobile.matches){nav.setAttribute('role','dialog');nav.setAttribute('aria-label','ナビゲーション');nav.setAttribute('aria-modal','true');nav.setAttribute('aria-hidden',String(!open));}
  else{['role','aria-label','aria-modal','aria-hidden'].forEach(attr=>nav.removeAttribute(attr));}
  if(open)setTimeout(()=>{if(nav.classList.contains('is-open'))close.focus();},260);else if(restore&&previousFocus){previousFocus.focus();previousFocus=null;}
 }
 toggle.hidden=false;
 toggle.addEventListener('click',()=>{
  setOpen(toggle.getAttribute('aria-expanded')!=='true');
  if(!mobile.matches){try{localStorage.setItem(storageKey,String(desktopOpen));}catch(error){/* Keep the current page usable without storage. */}}
 });
 close.addEventListener('click',()=>setOpen(false));backdrop.addEventListener('click',()=>setOpen(false));
 nav.addEventListener('click',e=>{if(e.target.closest('a')&&mobile.matches)setOpen(false);});
 document.addEventListener('keydown',e=>{
  if(!mobile.matches||toggle.getAttribute('aria-expanded')!=='true')return;
  if(e.key==='Escape'){e.preventDefault();setOpen(false);}
  if(e.key==='Tab'){
   const items=[...nav.querySelectorAll('button,a[href],input,select,textarea,[tabindex="0"]')].filter(el=>!el.disabled&&el.getClientRects().length);
   const first=items[0],last=items[items.length-1];
   if(e.shiftKey&&document.activeElement===first){e.preventDefault();last.focus();}
   else if(!e.shiftKey&&document.activeElement===last){e.preventDefault();first.focus();}
  }
 });
 mobile.addEventListener('change',()=>setOpen(mobile.matches?false:desktopOpen,false));setOpen(mobile.matches?false:desktopOpen,false);
}
const content=document.querySelector('.entry-content');
if(content){
 content.querySelectorAll('table').forEach(table=>{if(table.closest('.wp-block-table'))return;const wrap=document.createElement('div');wrap.className='table-scroll';wrap.tabIndex=0;wrap.setAttribute('role','region');wrap.setAttribute('aria-label','横にスクロールできる表');table.before(wrap);wrap.append(table);});
}
