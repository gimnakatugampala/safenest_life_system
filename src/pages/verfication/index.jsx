import React, { useRef, useState } from 'react'
import { useEffect } from 'react'

import Persona from "persona";

const index = () => {

      // -------- PERSONA ---------------
      const [options, setOptions] = useState({
        templateId: "itmpl_xQyvUgW3we5oj8ASNE1gXwj5gCYU",
      });
    
      // tmpl_JAZjHuAT738Q63BdgCuEJQre
    
      const [flowType, setFlowType] = useState("embedded");
    
      const embeddedClientRef = useRef(null);

    useEffect(() => {
     const client = new Persona.Client({
             templateId: "itmpl_xQyvUgW3we5oj8ASNE1gXwj5gCYU", // Make sure this is the production templateId
             environmentId: 'env_1ygTvMPiQKzcYNQGNi5YuFephsvm',
             onReady: () => client.open(),
             onLoad: (error) => {
               if (error) {
                 
                 console.error(
                   `Failed with code: ${error.code} and message ${error.message}`
                 );
               }
     
               client.open();
             },
             onStart: (inquiryId) => {
               console.log(`Started inquiry ${inquiryId}`);
             },
             onComplete: (inquiryId) => {
               console.log(`Sending finished inquiry ${inquiryId} to backend`);
            
     
               fetch(`/server-handler?inquiry-id=${inquiryId}`);
             },
             onEvent: (name, meta) => {
               switch (name) {
                 case "start":
                   console.log(`Received event: start`);
                   
                   break;
                 default:
                   
                   console.log(
                     `Received event: ${name} with meta: ${JSON.stringify(meta)}`
                   );
               }
             },
           });
           embeddedClientRef.current = client;
     
           window.exit = (force) =>
             client ? client.exit(force) : alert("Initialize client first");
           return;
    }, [])
    

  return (
    <div>index</div>
  )
}

export default index