# Pimcore Forms
This **Pimcore**-bundle aims to create a standardized, less cluttered way to build & handle forms in Pimcore.

This bundle was created to minimize efforts for developers. It does **not** provide a UI to create forms in Pimcore backend. 

###### Table of contents
- [Installation](/documentation/10_installation.md)
- [Configuration](/documentation/20_configuration.md)
- [Usage](/documentation/30_usage.md)
    - [Building the Form](/documentation/30_usage.md#building-the-form)
    - [Using Entities](/documentation/30_usage.md#using-entities)
    - [Using Multiple Forms on One Page](/documentation/30_usage.md#using-multiple-forms-on-one-page)

# When should I use this bundle?
Every time you create a web-app, containing at least one form, using Pimcore as CMS.

# Why should I use this bundle?
Almost every web-project with a frontend for the user (i.e., your client's client) has to deal with forms. As Pimcore builds
on top of Symfony, experienced Pimcore developers usually know the pain of creating forms using Symfony's form builder.

> The reason it is painful to use the form-builder is merely because it is **too powerful**. Meaning, there are just too
> many ways of how to build and handle a form. This leads to different implementations in large-scale projects, as every
> developer has a different coding-style - even with conventions in place.

To ease this pain, this bundle was created. It will enforce certain conventions by restricting the possibilities of how a
form is built and handled.