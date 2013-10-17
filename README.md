# wwsalesforce

eZPublish 4.* Extension to push Collectedinfo Data to Salesforce "Web to Lead" with CURL


Dependencies
==

cURL


Installation
==

1) Extract the archive into the /extension directory

2) Edit site.ini.append in /settings/override. Add the following to the file:

        [ExtensionSettings]
        ActiveExtensions[]=wwsalesforce

3) Edit extension/settings/wwsalesforce.ini.append.php and add your Config Data

4) Add an Attribute with attribute_identifier "lead_source" to your Form Class

        -> Only if the field is filled out, the data will be sent to Salesforce

5) Clear Cache and Regenerate autoloads


Usage
==

Add this Code to your collectedinfo Template:

    {if is_set($object.data_map.lead_source)}
        {if $object.data_map.lead_source.has_content}

        {let $postData = hash()}

       	    {set $postData = $postData|merge(hash('lead_source', $object.data_map.lead_source.content))}

        	{foreach $collection.data_map as $key => $post}

        	    {if $post.content|ne('')}
            	    {set $postData = $postData|merge(hash($key, $post.content))}
        	    {/if}

        	{/foreach}

            {def $salesforce_result = fetch( 'salesforce', 'web2lead', hash( formdata, $postData ) )}

        {/let}

        {/if}
    {/if}