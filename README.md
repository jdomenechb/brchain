# BRChain
[![Build Status](https://travis-ci.org/jdomenechb/brchain.svg?branch=master)](https://travis-ci.org/jdomenechb/brchain)

Transformation and validation of data sources using an unified language.

## Glossary
| Term | Definition |
| --- | --- |
| Item | Any of the pieces or chunks that form the chain. |
| Chain | Union of Items that form a tree. It can be contained inside some Items. |
| Condition | Executes the chain that contains only if the evaluation of the Condition name is true. It can also be negated. |
| Navigation | Items that help traversing the source document. |
| Source | Represents a document in an specific language (XML, JSON...). |
| Source Item | Wrapper for an extract of the source, that has meaning for itself (an XML Node, a vector, a JSON object...). |
| String | Item that can be a property of another, and represents an string. |
| Transformation | Items that are able to modify the content of the source. |


