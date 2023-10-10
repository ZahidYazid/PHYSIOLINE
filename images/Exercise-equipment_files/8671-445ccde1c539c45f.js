"use strict";(self.webpackChunk_N_E=self.webpackChunk_N_E||[]).push([[8671],{15761:function(t,e,i){i.d(e,{j:function(){return o}});var n=i(33989),s=i(32161);class r extends n.l{constructor(){super(),this.setup=t=>{if(!s.sk&&window.addEventListener){const e=()=>t();return window.addEventListener("visibilitychange",e,!1),window.addEventListener("focus",e,!1),()=>{window.removeEventListener("visibilitychange",e),window.removeEventListener("focus",e)}}}}onSubscribe(){this.cleanup||this.setEventListener(this.setup)}onUnsubscribe(){var t;this.hasListeners()||(null==(t=this.cleanup)||t.call(this),this.cleanup=void 0)}setEventListener(t){var e;this.setup=t,null==(e=this.cleanup)||e.call(this),this.cleanup=t((t=>{"boolean"===typeof t?this.setFocused(t):this.onFocus()}))}setFocused(t){this.focused=t,t&&this.onFocus()}onFocus(){this.listeners.forEach((t=>{t()}))}isFocused(){return"boolean"===typeof this.focused?this.focused:"undefined"===typeof document||[void 0,"visible","prerender"].includes(document.visibilityState)}}const o=new r},30081:function(t,e,i){i.d(e,{V:function(){return s}});var n=i(32161);const s=function(){let t=[],e=0,i=t=>{t()},s=t=>{t()};const r=s=>{e?t.push(s):(0,n.A4)((()=>{i(s)}))},o=()=>{const e=t;t=[],e.length&&(0,n.A4)((()=>{s((()=>{e.forEach((t=>{i(t)}))}))}))};return{batch:t=>{let i;e++;try{i=t()}finally{e--,e||o()}return i},batchCalls:t=>(...e)=>{r((()=>{t(...e)}))},schedule:r,setNotifyFunction:t=>{i=t},setBatchNotifyFunction:t=>{s=t}}}()},96474:function(t,e,i){i.d(e,{N:function(){return o}});var n=i(33989),s=i(32161);class r extends n.l{constructor(){super(),this.setup=t=>{if(!s.sk&&window.addEventListener){const e=()=>t();return window.addEventListener("online",e,!1),window.addEventListener("offline",e,!1),()=>{window.removeEventListener("online",e),window.removeEventListener("offline",e)}}}}onSubscribe(){this.cleanup||this.setEventListener(this.setup)}onUnsubscribe(){var t;this.hasListeners()||(null==(t=this.cleanup)||t.call(this),this.cleanup=void 0)}setEventListener(t){var e;this.setup=t,null==(e=this.cleanup)||e.call(this),this.cleanup=t((t=>{"boolean"===typeof t?this.setOnline(t):this.onOnline()}))}setOnline(t){this.online=t,t&&this.onOnline()}onOnline(){this.listeners.forEach((t=>{t()}))}isOnline(){return"boolean"===typeof this.online?this.online:"undefined"===typeof navigator||"undefined"===typeof navigator.onLine||navigator.onLine}}const o=new r},526:function(t,e,i){i.d(e,{S:function(){return b}});var n=i(32161);const s=console;var r=i(30081),o=i(72379);class a{destroy(){this.clearGcTimeout()}scheduleGc(){this.clearGcTimeout(),(0,n.PN)(this.cacheTime)&&(this.gcTimeout=setTimeout((()=>{this.optionalRemove()}),this.cacheTime))}updateCacheTime(t){this.cacheTime=Math.max(this.cacheTime||0,null!=t?t:n.sk?1/0:3e5)}clearGcTimeout(){this.gcTimeout&&(clearTimeout(this.gcTimeout),this.gcTimeout=void 0)}}class u extends a{constructor(t){super(),this.abortSignalConsumed=!1,this.defaultOptions=t.defaultOptions,this.setOptions(t.options),this.observers=[],this.cache=t.cache,this.logger=t.logger||s,this.queryKey=t.queryKey,this.queryHash=t.queryHash,this.initialState=t.state||function(t){const e="function"===typeof t.initialData?t.initialData():t.initialData,i="undefined"!==typeof e,n=i?"function"===typeof t.initialDataUpdatedAt?t.initialDataUpdatedAt():t.initialDataUpdatedAt:0;return{data:e,dataUpdateCount:0,dataUpdatedAt:i?null!=n?n:Date.now():0,error:null,errorUpdateCount:0,errorUpdatedAt:0,fetchFailureCount:0,fetchFailureReason:null,fetchMeta:null,isInvalidated:!1,status:i?"success":"loading",fetchStatus:"idle"}}(this.options),this.state=this.initialState,this.scheduleGc()}get meta(){return this.options.meta}setOptions(t){this.options={...this.defaultOptions,...t},this.updateCacheTime(this.options.cacheTime)}optionalRemove(){this.observers.length||"idle"!==this.state.fetchStatus||this.cache.remove(this)}setData(t,e){const i=(0,n.oE)(this.state.data,t,this.options);return this.dispatch({data:i,type:"success",dataUpdatedAt:null==e?void 0:e.updatedAt,manual:null==e?void 0:e.manual}),i}setState(t,e){this.dispatch({type:"setState",state:t,setStateOptions:e})}cancel(t){var e;const i=this.promise;return null==(e=this.retryer)||e.cancel(t),i?i.then(n.ZT).catch(n.ZT):Promise.resolve()}destroy(){super.destroy(),this.cancel({silent:!0})}reset(){this.destroy(),this.setState(this.initialState)}isActive(){return this.observers.some((t=>!1!==t.options.enabled))}isDisabled(){return this.getObserversCount()>0&&!this.isActive()}isStale(){return this.state.isInvalidated||!this.state.dataUpdatedAt||this.observers.some((t=>t.getCurrentResult().isStale))}isStaleByTime(t=0){return this.state.isInvalidated||!this.state.dataUpdatedAt||!(0,n.Kp)(this.state.dataUpdatedAt,t)}onFocus(){var t;const e=this.observers.find((t=>t.shouldFetchOnWindowFocus()));e&&e.refetch({cancelRefetch:!1}),null==(t=this.retryer)||t.continue()}onOnline(){var t;const e=this.observers.find((t=>t.shouldFetchOnReconnect()));e&&e.refetch({cancelRefetch:!1}),null==(t=this.retryer)||t.continue()}addObserver(t){-1===this.observers.indexOf(t)&&(this.observers.push(t),this.clearGcTimeout(),this.cache.notify({type:"observerAdded",query:this,observer:t}))}removeObserver(t){-1!==this.observers.indexOf(t)&&(this.observers=this.observers.filter((e=>e!==t)),this.observers.length||(this.retryer&&(this.abortSignalConsumed?this.retryer.cancel({revert:!0}):this.retryer.cancelRetry()),this.scheduleGc()),this.cache.notify({type:"observerRemoved",query:this,observer:t}))}getObserversCount(){return this.observers.length}invalidate(){this.state.isInvalidated||this.dispatch({type:"invalidate"})}fetch(t,e){var i,s;if("idle"!==this.state.fetchStatus)if(this.state.dataUpdatedAt&&null!=e&&e.cancelRefetch)this.cancel({silent:!0});else if(this.promise){var r;return null==(r=this.retryer)||r.continueRetry(),this.promise}if(t&&this.setOptions(t),!this.options.queryFn){const t=this.observers.find((t=>t.options.queryFn));t&&this.setOptions(t.options)}Array.isArray(this.options.queryKey);const a=(0,n.G9)(),u={queryKey:this.queryKey,pageParam:void 0,meta:this.meta},c=t=>{Object.defineProperty(t,"signal",{enumerable:!0,get:()=>{if(a)return this.abortSignalConsumed=!0,a.signal}})};c(u);const h={fetchOptions:e,options:this.options,queryKey:this.queryKey,state:this.state,fetchFn:()=>this.options.queryFn?(this.abortSignalConsumed=!1,this.options.queryFn(u)):Promise.reject("Missing queryFn")};var l;(c(h),null==(i=this.options.behavior)||i.onFetch(h),this.revertState=this.state,"idle"===this.state.fetchStatus||this.state.fetchMeta!==(null==(s=h.fetchOptions)?void 0:s.meta))&&this.dispatch({type:"fetch",meta:null==(l=h.fetchOptions)?void 0:l.meta});const d=t=>{var e,i,n,s;((0,o.DV)(t)&&t.silent||this.dispatch({type:"error",error:t}),(0,o.DV)(t))||(null==(e=(i=this.cache.config).onError)||e.call(i,t,this),null==(n=(s=this.cache.config).onSettled)||n.call(s,this.state.data,t,this));this.isFetchingOptimistic||this.scheduleGc(),this.isFetchingOptimistic=!1};return this.retryer=(0,o.Mz)({fn:h.fetchFn,abort:null==a?void 0:a.abort.bind(a),onSuccess:t=>{var e,i,n,s;"undefined"!==typeof t?(this.setData(t),null==(e=(i=this.cache.config).onSuccess)||e.call(i,t,this),null==(n=(s=this.cache.config).onSettled)||n.call(s,t,this.state.error,this),this.isFetchingOptimistic||this.scheduleGc(),this.isFetchingOptimistic=!1):d(new Error("undefined"))},onError:d,onFail:(t,e)=>{this.dispatch({type:"failed",failureCount:t,error:e})},onPause:()=>{this.dispatch({type:"pause"})},onContinue:()=>{this.dispatch({type:"continue"})},retry:h.options.retry,retryDelay:h.options.retryDelay,networkMode:h.options.networkMode}),this.promise=this.retryer.promise,this.promise}dispatch(t){this.state=(e=>{var i,n;switch(t.type){case"failed":return{...e,fetchFailureCount:t.failureCount,fetchFailureReason:t.error};case"pause":return{...e,fetchStatus:"paused"};case"continue":return{...e,fetchStatus:"fetching"};case"fetch":return{...e,fetchFailureCount:0,fetchFailureReason:null,fetchMeta:null!=(i=t.meta)?i:null,fetchStatus:(0,o.Kw)(this.options.networkMode)?"fetching":"paused",...!e.dataUpdatedAt&&{error:null,status:"loading"}};case"success":return{...e,data:t.data,dataUpdateCount:e.dataUpdateCount+1,dataUpdatedAt:null!=(n=t.dataUpdatedAt)?n:Date.now(),error:null,isInvalidated:!1,status:"success",...!t.manual&&{fetchStatus:"idle",fetchFailureCount:0,fetchFailureReason:null}};case"error":const s=t.error;return(0,o.DV)(s)&&s.revert&&this.revertState?{...this.revertState}:{...e,error:s,errorUpdateCount:e.errorUpdateCount+1,errorUpdatedAt:Date.now(),fetchFailureCount:e.fetchFailureCount+1,fetchFailureReason:s,fetchStatus:"idle",status:"error"};case"invalidate":return{...e,isInvalidated:!0};case"setState":return{...e,...t.state}}})(this.state),r.V.batch((()=>{this.observers.forEach((e=>{e.onQueryUpdate(t)})),this.cache.notify({query:this,type:"updated",action:t})}))}}var c=i(33989);class h extends c.l{constructor(t){super(),this.config=t||{},this.queries=[],this.queriesMap={}}build(t,e,i){var s;const r=e.queryKey,o=null!=(s=e.queryHash)?s:(0,n.Rm)(r,e);let a=this.get(o);return a||(a=new u({cache:this,logger:t.getLogger(),queryKey:r,queryHash:o,options:t.defaultQueryOptions(e),state:i,defaultOptions:t.getQueryDefaults(r)}),this.add(a)),a}add(t){this.queriesMap[t.queryHash]||(this.queriesMap[t.queryHash]=t,this.queries.push(t),this.notify({type:"added",query:t}))}remove(t){const e=this.queriesMap[t.queryHash];e&&(t.destroy(),this.queries=this.queries.filter((e=>e!==t)),e===t&&delete this.queriesMap[t.queryHash],this.notify({type:"removed",query:t}))}clear(){r.V.batch((()=>{this.queries.forEach((t=>{this.remove(t)}))}))}get(t){return this.queriesMap[t]}getAll(){return this.queries}find(t,e){const[i]=(0,n.I6)(t,e);return"undefined"===typeof i.exact&&(i.exact=!0),this.queries.find((t=>(0,n._x)(i,t)))}findAll(t,e){const[i]=(0,n.I6)(t,e);return Object.keys(i).length>0?this.queries.filter((t=>(0,n._x)(i,t))):this.queries}notify(t){r.V.batch((()=>{this.listeners.forEach((e=>{e(t)}))}))}onFocus(){r.V.batch((()=>{this.queries.forEach((t=>{t.onFocus()}))}))}onOnline(){r.V.batch((()=>{this.queries.forEach((t=>{t.onOnline()}))}))}}class l extends a{constructor(t){super(),this.defaultOptions=t.defaultOptions,this.mutationId=t.mutationId,this.mutationCache=t.mutationCache,this.logger=t.logger||s,this.observers=[],this.state=t.state||{context:void 0,data:void 0,error:null,failureCount:0,failureReason:null,isPaused:!1,status:"idle",variables:void 0},this.setOptions(t.options),this.scheduleGc()}setOptions(t){this.options={...this.defaultOptions,...t},this.updateCacheTime(this.options.cacheTime)}get meta(){return this.options.meta}setState(t){this.dispatch({type:"setState",state:t})}addObserver(t){-1===this.observers.indexOf(t)&&(this.observers.push(t),this.clearGcTimeout(),this.mutationCache.notify({type:"observerAdded",mutation:this,observer:t}))}removeObserver(t){this.observers=this.observers.filter((e=>e!==t)),this.scheduleGc(),this.mutationCache.notify({type:"observerRemoved",mutation:this,observer:t})}optionalRemove(){this.observers.length||("loading"===this.state.status?this.scheduleGc():this.mutationCache.remove(this))}continue(){var t,e;return null!=(t=null==(e=this.retryer)?void 0:e.continue())?t:this.execute()}async execute(){const t=()=>{var t;return this.retryer=(0,o.Mz)({fn:()=>this.options.mutationFn?this.options.mutationFn(this.state.variables):Promise.reject("No mutationFn found"),onFail:(t,e)=>{this.dispatch({type:"failed",failureCount:t,error:e})},onPause:()=>{this.dispatch({type:"pause"})},onContinue:()=>{this.dispatch({type:"continue"})},retry:null!=(t=this.options.retry)?t:0,retryDelay:this.options.retryDelay,networkMode:this.options.networkMode}),this.retryer.promise},e="loading"===this.state.status;try{var i,n,s,r,a,u,c,h;if(!e){var l,d,f,y;this.dispatch({type:"loading",variables:this.options.variables}),await(null==(l=(d=this.mutationCache.config).onMutate)?void 0:l.call(d,this.state.variables,this));const t=await(null==(f=(y=this.options).onMutate)?void 0:f.call(y,this.state.variables));t!==this.state.context&&this.dispatch({type:"loading",context:t,variables:this.state.variables})}const o=await t();return await(null==(i=(n=this.mutationCache.config).onSuccess)?void 0:i.call(n,o,this.state.variables,this.state.context,this)),await(null==(s=(r=this.options).onSuccess)?void 0:s.call(r,o,this.state.variables,this.state.context)),await(null==(a=(u=this.mutationCache.config).onSettled)?void 0:a.call(u,o,null,this.state.variables,this.state.context,this)),await(null==(c=(h=this.options).onSettled)?void 0:c.call(h,o,null,this.state.variables,this.state.context)),this.dispatch({type:"success",data:o}),o}catch(w){try{var p,v,m,b,g,C,q,O;throw await(null==(p=(v=this.mutationCache.config).onError)?void 0:p.call(v,w,this.state.variables,this.state.context,this)),await(null==(m=(b=this.options).onError)?void 0:m.call(b,w,this.state.variables,this.state.context)),await(null==(g=(C=this.mutationCache.config).onSettled)?void 0:g.call(C,void 0,w,this.state.variables,this.state.context,this)),await(null==(q=(O=this.options).onSettled)?void 0:q.call(O,void 0,w,this.state.variables,this.state.context)),w}finally{this.dispatch({type:"error",error:w})}}}dispatch(t){this.state=(e=>{switch(t.type){case"failed":return{...e,failureCount:t.failureCount,failureReason:t.error};case"pause":return{...e,isPaused:!0};case"continue":return{...e,isPaused:!1};case"loading":return{...e,context:t.context,data:void 0,failureCount:0,failureReason:null,error:null,isPaused:!(0,o.Kw)(this.options.networkMode),status:"loading",variables:t.variables};case"success":return{...e,data:t.data,failureCount:0,failureReason:null,error:null,status:"success",isPaused:!1};case"error":return{...e,data:void 0,error:t.error,failureCount:e.failureCount+1,failureReason:t.error,isPaused:!1,status:"error"};case"setState":return{...e,...t.state}}})(this.state),r.V.batch((()=>{this.observers.forEach((e=>{e.onMutationUpdate(t)})),this.mutationCache.notify({mutation:this,type:"updated",action:t})}))}}class d extends c.l{constructor(t){super(),this.config=t||{},this.mutations=[],this.mutationId=0}build(t,e,i){const n=new l({mutationCache:this,logger:t.getLogger(),mutationId:++this.mutationId,options:t.defaultMutationOptions(e),state:i,defaultOptions:e.mutationKey?t.getMutationDefaults(e.mutationKey):void 0});return this.add(n),n}add(t){this.mutations.push(t),this.notify({type:"added",mutation:t})}remove(t){this.mutations=this.mutations.filter((e=>e!==t)),this.notify({type:"removed",mutation:t})}clear(){r.V.batch((()=>{this.mutations.forEach((t=>{this.remove(t)}))}))}getAll(){return this.mutations}find(t){return"undefined"===typeof t.exact&&(t.exact=!0),this.mutations.find((e=>(0,n.X7)(t,e)))}findAll(t){return this.mutations.filter((e=>(0,n.X7)(t,e)))}notify(t){r.V.batch((()=>{this.listeners.forEach((e=>{e(t)}))}))}resumePausedMutations(){var t;return this.resuming=(null!=(t=this.resuming)?t:Promise.resolve()).then((()=>{const t=this.mutations.filter((t=>t.state.isPaused));return r.V.batch((()=>t.reduce(((t,e)=>t.then((()=>e.continue().catch(n.ZT)))),Promise.resolve())))})).then((()=>{this.resuming=void 0})),this.resuming}}var f=i(15761),y=i(96474);function p(){return{onFetch:t=>{t.fetchFn=()=>{var e,i,n,s,r,o;const a=null==(e=t.fetchOptions)||null==(i=e.meta)?void 0:i.refetchPage,u=null==(n=t.fetchOptions)||null==(s=n.meta)?void 0:s.fetchMore,c=null==u?void 0:u.pageParam,h="forward"===(null==u?void 0:u.direction),l="backward"===(null==u?void 0:u.direction),d=(null==(r=t.state.data)?void 0:r.pages)||[],f=(null==(o=t.state.data)?void 0:o.pageParams)||[];let y=f,p=!1;const b=t.options.queryFn||(()=>Promise.reject("Missing queryFn")),g=(t,e,i,n)=>(y=n?[e,...y]:[...y,e],n?[i,...t]:[...t,i]),C=(e,i,n,s)=>{if(p)return Promise.reject("Cancelled");if("undefined"===typeof n&&!i&&e.length)return Promise.resolve(e);const r={queryKey:t.queryKey,pageParam:n,meta:t.options.meta};var o;o=r,Object.defineProperty(o,"signal",{enumerable:!0,get:()=>{var e,i;return null!=(e=t.signal)&&e.aborted?p=!0:null==(i=t.signal)||i.addEventListener("abort",(()=>{p=!0})),t.signal}});const a=b(r);return Promise.resolve(a).then((t=>g(e,n,t,s)))};let q;if(d.length)if(h){const e="undefined"!==typeof c,i=e?c:v(t.options,d);q=C(d,e,i)}else if(l){const e="undefined"!==typeof c,i=e?c:m(t.options,d);q=C(d,e,i,!0)}else{y=[];const e="undefined"===typeof t.options.getNextPageParam;q=!a||!d[0]||a(d[0],0,d)?C([],e,f[0]):Promise.resolve(g([],f[0],d[0]));for(let i=1;i<d.length;i++)q=q.then((n=>{if(!a||!d[i]||a(d[i],i,d)){const s=e?f[i]:v(t.options,n);return C(n,e,s)}return Promise.resolve(g(n,f[i],d[i]))}))}else q=C([]);return q.then((t=>({pages:t,pageParams:y})))}}}}function v(t,e){return null==t.getNextPageParam?void 0:t.getNextPageParam(e[e.length-1],e)}function m(t,e){return null==t.getPreviousPageParam?void 0:t.getPreviousPageParam(e[0],e)}class b{constructor(t={}){this.queryCache=t.queryCache||new h,this.mutationCache=t.mutationCache||new d,this.logger=t.logger||s,this.defaultOptions=t.defaultOptions||{},this.queryDefaults=[],this.mutationDefaults=[],this.mountCount=0}mount(){this.mountCount++,1===this.mountCount&&(this.unsubscribeFocus=f.j.subscribe((()=>{f.j.isFocused()&&(this.resumePausedMutations(),this.queryCache.onFocus())})),this.unsubscribeOnline=y.N.subscribe((()=>{y.N.isOnline()&&(this.resumePausedMutations(),this.queryCache.onOnline())})))}unmount(){var t,e;this.mountCount--,0===this.mountCount&&(null==(t=this.unsubscribeFocus)||t.call(this),this.unsubscribeFocus=void 0,null==(e=this.unsubscribeOnline)||e.call(this),this.unsubscribeOnline=void 0)}isFetching(t,e){const[i]=(0,n.I6)(t,e);return i.fetchStatus="fetching",this.queryCache.findAll(i).length}isMutating(t){return this.mutationCache.findAll({...t,fetching:!0}).length}getQueryData(t,e){var i;return null==(i=this.queryCache.find(t,e))?void 0:i.state.data}ensureQueryData(t,e,i){const s=(0,n._v)(t,e,i),r=this.getQueryData(s.queryKey);return r?Promise.resolve(r):this.fetchQuery(s)}getQueriesData(t){return this.getQueryCache().findAll(t).map((({queryKey:t,state:e})=>[t,e.data]))}setQueryData(t,e,i){const s=this.queryCache.find(t),r=null==s?void 0:s.state.data,o=(0,n.SE)(e,r);if("undefined"===typeof o)return;const a=(0,n._v)(t),u=this.defaultQueryOptions(a);return this.queryCache.build(this,u).setData(o,{...i,manual:!0})}setQueriesData(t,e,i){return r.V.batch((()=>this.getQueryCache().findAll(t).map((({queryKey:t})=>[t,this.setQueryData(t,e,i)]))))}getQueryState(t,e){var i;return null==(i=this.queryCache.find(t,e))?void 0:i.state}removeQueries(t,e){const[i]=(0,n.I6)(t,e),s=this.queryCache;r.V.batch((()=>{s.findAll(i).forEach((t=>{s.remove(t)}))}))}resetQueries(t,e,i){const[s,o]=(0,n.I6)(t,e,i),a=this.queryCache,u={type:"active",...s};return r.V.batch((()=>(a.findAll(s).forEach((t=>{t.reset()})),this.refetchQueries(u,o))))}cancelQueries(t,e,i){const[s,o={}]=(0,n.I6)(t,e,i);"undefined"===typeof o.revert&&(o.revert=!0);const a=r.V.batch((()=>this.queryCache.findAll(s).map((t=>t.cancel(o)))));return Promise.all(a).then(n.ZT).catch(n.ZT)}invalidateQueries(t,e,i){const[s,o]=(0,n.I6)(t,e,i);return r.V.batch((()=>{var t,e;if(this.queryCache.findAll(s).forEach((t=>{t.invalidate()})),"none"===s.refetchType)return Promise.resolve();const i={...s,type:null!=(t=null!=(e=s.refetchType)?e:s.type)?t:"active"};return this.refetchQueries(i,o)}))}refetchQueries(t,e,i){const[s,o]=(0,n.I6)(t,e,i),a=r.V.batch((()=>this.queryCache.findAll(s).filter((t=>!t.isDisabled())).map((t=>{var e;return t.fetch(void 0,{...o,cancelRefetch:null==(e=null==o?void 0:o.cancelRefetch)||e,meta:{refetchPage:s.refetchPage}})}))));let u=Promise.all(a).then(n.ZT);return null!=o&&o.throwOnError||(u=u.catch(n.ZT)),u}fetchQuery(t,e,i){const s=(0,n._v)(t,e,i),r=this.defaultQueryOptions(s);"undefined"===typeof r.retry&&(r.retry=!1);const o=this.queryCache.build(this,r);return o.isStaleByTime(r.staleTime)?o.fetch(r):Promise.resolve(o.state.data)}prefetchQuery(t,e,i){return this.fetchQuery(t,e,i).then(n.ZT).catch(n.ZT)}fetchInfiniteQuery(t,e,i){const s=(0,n._v)(t,e,i);return s.behavior=p(),this.fetchQuery(s)}prefetchInfiniteQuery(t,e,i){return this.fetchInfiniteQuery(t,e,i).then(n.ZT).catch(n.ZT)}resumePausedMutations(){return this.mutationCache.resumePausedMutations()}getQueryCache(){return this.queryCache}getMutationCache(){return this.mutationCache}getLogger(){return this.logger}getDefaultOptions(){return this.defaultOptions}setDefaultOptions(t){this.defaultOptions=t}setQueryDefaults(t,e){const i=this.queryDefaults.find((e=>(0,n.yF)(t)===(0,n.yF)(e.queryKey)));i?i.defaultOptions=e:this.queryDefaults.push({queryKey:t,defaultOptions:e})}getQueryDefaults(t){if(!t)return;const e=this.queryDefaults.find((e=>(0,n.to)(t,e.queryKey)));return null==e?void 0:e.defaultOptions}setMutationDefaults(t,e){const i=this.mutationDefaults.find((e=>(0,n.yF)(t)===(0,n.yF)(e.mutationKey)));i?i.defaultOptions=e:this.mutationDefaults.push({mutationKey:t,defaultOptions:e})}getMutationDefaults(t){if(!t)return;const e=this.mutationDefaults.find((e=>(0,n.to)(t,e.mutationKey)));return null==e?void 0:e.defaultOptions}defaultQueryOptions(t){if(null!=t&&t._defaulted)return t;const e={...this.defaultOptions.queries,...this.getQueryDefaults(null==t?void 0:t.queryKey),...t,_defaulted:!0};return!e.queryHash&&e.queryKey&&(e.queryHash=(0,n.Rm)(e.queryKey,e)),"undefined"===typeof e.refetchOnReconnect&&(e.refetchOnReconnect="always"!==e.networkMode),"undefined"===typeof e.useErrorBoundary&&(e.useErrorBoundary=!!e.suspense),e}defaultMutationOptions(t){return null!=t&&t._defaulted?t:{...this.defaultOptions.mutations,...this.getMutationDefaults(null==t?void 0:t.mutationKey),...t,_defaulted:!0}}clear(){this.queryCache.clear(),this.mutationCache.clear()}}},72379:function(t,e,i){i.d(e,{DV:function(){return c},Kw:function(){return a},Mz:function(){return h}});var n=i(15761),s=i(96474),r=i(32161);function o(t){return Math.min(1e3*2**t,3e4)}function a(t){return"online"!==(null!=t?t:"online")||s.N.isOnline()}class u{constructor(t){this.revert=null==t?void 0:t.revert,this.silent=null==t?void 0:t.silent}}function c(t){return t instanceof u}function h(t){let e,i,c,h=!1,l=0,d=!1;const f=new Promise(((t,e)=>{i=t,c=e})),y=()=>!n.j.isFocused()||"always"!==t.networkMode&&!s.N.isOnline(),p=n=>{d||(d=!0,null==t.onSuccess||t.onSuccess(n),null==e||e(),i(n))},v=i=>{d||(d=!0,null==t.onError||t.onError(i),null==e||e(),c(i))},m=()=>new Promise((i=>{e=t=>{const e=d||!y();return e&&i(t),e},null==t.onPause||t.onPause()})).then((()=>{e=void 0,d||null==t.onContinue||t.onContinue()})),b=()=>{if(d)return;let e;try{e=t.fn()}catch(i){e=Promise.reject(i)}Promise.resolve(e).then(p).catch((e=>{var i,n;if(d)return;const s=null!=(i=t.retry)?i:3,a=null!=(n=t.retryDelay)?n:o,u="function"===typeof a?a(l,e):a,c=!0===s||"number"===typeof s&&l<s||"function"===typeof s&&s(l,e);!h&&c?(l++,null==t.onFail||t.onFail(l,e),(0,r.Gh)(u).then((()=>{if(y())return m()})).then((()=>{h?v(e):b()}))):v(e)}))};return a(t.networkMode)?b():m().then(b),{promise:f,cancel:e=>{d||(v(new u(e)),null==t.abort||t.abort())},continue:()=>(null==e?void 0:e())?f:Promise.resolve(),cancelRetry:()=>{h=!0},continueRetry:()=>{h=!1}}}},33989:function(t,e,i){i.d(e,{l:function(){return n}});class n{constructor(){this.listeners=[],this.subscribe=this.subscribe.bind(this)}subscribe(t){return this.listeners.push(t),this.onSubscribe(),()=>{this.listeners=this.listeners.filter((e=>e!==t)),this.onUnsubscribe()}}hasListeners(){return this.listeners.length>0}onSubscribe(){}onUnsubscribe(){}}},32161:function(t,e,i){i.d(e,{A4:function(){return w},G9:function(){return P},Gh:function(){return O},I6:function(){return c},Kp:function(){return a},PN:function(){return o},Rm:function(){return d},SE:function(){return r},VS:function(){return m},X7:function(){return l},ZT:function(){return s},_v:function(){return u},_x:function(){return h},oE:function(){return S},sk:function(){return n},to:function(){return y},yF:function(){return f}});const n="undefined"===typeof window||"Deno"in window;function s(){}function r(t,e){return"function"===typeof t?t(e):t}function o(t){return"number"===typeof t&&t>=0&&t!==1/0}function a(t,e){return Math.max(t+(e||0)-Date.now(),0)}function u(t,e,i){return q(t)?"function"===typeof e?{...i,queryKey:t,queryFn:e}:{...e,queryKey:t}:t}function c(t,e,i){return q(t)?[{...e,queryKey:t},i]:[t||{},e]}function h(t,e){const{type:i="all",exact:n,fetchStatus:s,predicate:r,queryKey:o,stale:a}=t;if(q(o))if(n){if(e.queryHash!==d(o,e.options))return!1}else if(!y(e.queryKey,o))return!1;if("all"!==i){const t=e.isActive();if("active"===i&&!t)return!1;if("inactive"===i&&t)return!1}return("boolean"!==typeof a||e.isStale()===a)&&(("undefined"===typeof s||s===e.state.fetchStatus)&&!(r&&!r(e)))}function l(t,e){const{exact:i,fetching:n,predicate:s,mutationKey:r}=t;if(q(r)){if(!e.options.mutationKey)return!1;if(i){if(f(e.options.mutationKey)!==f(r))return!1}else if(!y(e.options.mutationKey,r))return!1}return("boolean"!==typeof n||"loading"===e.state.status===n)&&!(s&&!s(e))}function d(t,e){return((null==e?void 0:e.queryKeyHashFn)||f)(t)}function f(t){return JSON.stringify(t,((t,e)=>g(e)?Object.keys(e).sort().reduce(((t,i)=>(t[i]=e[i],t)),{}):e))}function y(t,e){return p(t,e)}function p(t,e){return t===e||typeof t===typeof e&&(!(!t||!e||"object"!==typeof t||"object"!==typeof e)&&!Object.keys(e).some((i=>!p(t[i],e[i]))))}function v(t,e){if(t===e)return t;const i=b(t)&&b(e);if(i||g(t)&&g(e)){const n=i?t.length:Object.keys(t).length,s=i?e:Object.keys(e),r=s.length,o=i?[]:{};let a=0;for(let u=0;u<r;u++){const n=i?u:s[u];o[n]=v(t[n],e[n]),o[n]===t[n]&&a++}return n===r&&a===n?t:o}return e}function m(t,e){if(t&&!e||e&&!t)return!1;for(const i in t)if(t[i]!==e[i])return!1;return!0}function b(t){return Array.isArray(t)&&t.length===Object.keys(t).length}function g(t){if(!C(t))return!1;const e=t.constructor;if("undefined"===typeof e)return!0;const i=e.prototype;return!!C(i)&&!!i.hasOwnProperty("isPrototypeOf")}function C(t){return"[object Object]"===Object.prototype.toString.call(t)}function q(t){return Array.isArray(t)}function O(t){return new Promise((e=>{setTimeout(e,t)}))}function w(t){O(0).then(t)}function P(){if("function"===typeof AbortController)return new AbortController}function S(t,e,i){return null!=i.isDataEqual&&i.isDataEqual(t,e)?t:"function"===typeof i.structuralSharing?i.structuralSharing(t,e):!1!==i.structuralSharing?v(t,e):e}},85945:function(t,e,i){i.d(e,{NL:function(){return a},aH:function(){return u}});var n=i(67294);const s=n.createContext(void 0),r=n.createContext(!1);function o(t,e){return t||(e&&"undefined"!==typeof window?(window.ReactQueryClientContext||(window.ReactQueryClientContext=s),window.ReactQueryClientContext):s)}const a=({context:t}={})=>{const e=n.useContext(o(t,n.useContext(r)));if(!e)throw new Error("No QueryClient set, use QueryClientProvider to set one");return e},u=({client:t,children:e,context:i,contextSharing:s=!1})=>{n.useEffect((()=>(t.mount(),()=>{t.unmount()})),[t]);const a=o(i,s);return n.createElement(r.Provider,{value:!i&&s},n.createElement(a.Provider,{value:t},e))}}}]);