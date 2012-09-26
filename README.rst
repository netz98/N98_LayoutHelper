N98_LayoutHelper Magento Module
===============================

Helpful methods to be called in layout actions to allow more 
customizations via local.xml without touching the original layout files.

* Remove links from the account navigation from local.xml layout updates 
without touching the original layout files.

* Add CSS/JS before or after existing elements

Example: Add CSS file at begin

.. code-block:: xml

    <reference name="head">
        <action method="addCss">
            <stylesheet>css/footer.css</stylesheet>
            <params></params>
            <ref>*</ref>
            <before>1</before>
        </action>
    </reference>

Example: Remove a link from customer menu

.. code-block:: xml

    <customer_account>
        <reference name="customer_account_navigation">
            <action method="removeLink"><name>OAuth Customer Tokens</name></action>
            <action method="removeLink"><name>billing_agreements</name></action>
            <action method="removeLink"><name>recurring_profiles</name></action>
        </reference>
    </customer_account>