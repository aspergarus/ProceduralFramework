# ProceduralFramework
Tiny framework, or even library that support some basic operations like routing, template system and etc. Main aim here was to challenge myself to avoid any classes and OOP features in order to create minimal framework/lib that can help to build some app. For example blog.

## Naming

it's named ProceduralFramework, as it doesn't use any classes, only functions. But it's hard to name it as Functional framework, as functions here basically are not pure and hold the state.

## Challange

The main challange was how to keep state of the app. In OOP state can be some object, which we pass to app object, and then we may ask whenever we want it.
But pretending that objects don't exists, we need to deal only with functions. So here I see 3 ways how to do it.

1. Using global variables. [Example of router](https://gist.github.com/aspergarus/0f632bc9050f8f851927b9f522a9a61e)
2. Using static variables inside functions. [Example](https://gist.github.com/aspergarus/b26c5ce90138d689ca5641644ece7b94)
3. Using functions as closure with closed state from the caller.
4. Using passing parameters everytime when we need some state.

I rejected 1, as it's really easy to implement, but sometimes you may get into trouble since you have global scope, and every know that global is evil.
Also I rejected 3, since it makes code really hard to support. 
Variant #4 seems to me the best, but it requires additional work everytime when we need to use some 'global' config. So, it's possible to develop it, but require solid investigation and preparation. Because if you will not prepare properly, you will change your architecture too often, which requires a lot of changes.

Therefore my choice is #2. Yeah, it's not so perfect, and actually it also exposes everything in global scope, you just need to use proper function. But at least it makes more safe naming of data, comparing to global scope.
