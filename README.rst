N98_LayoutHelper Magento Module
===============================

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
