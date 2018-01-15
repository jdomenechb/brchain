<?php
$header = <<<'HEADER'
This file is part of the brchain package.

(c) Jordi Domènech Bonilla

For the full copyright and license information, please view the LICENSE
file that was distributed with this source code.
HEADER;
$config = PhpCsFixer\Config::create()
    ->setRules([
        '@PSR2' => true,
        '@Symfony' => true,
        '@PHP70Migration' => true,
        '@PHP71Migration' => true,
        '@DoctrineAnnotation' => true,
        'align_multiline_comment' => ['comment_type' => 'all_multiline'],
        'array_syntax' => ['syntax' => 'short'],
        'combine_consecutive_issets' => true,
        'combine_consecutive_unsets' => true,
        'concat_space' => ['spacing' => 'one'],
        'escape_implicit_backslashes' => ['double_quoted' => true, 'heredoc_syntax' => true, 'single_quoted' => true],
        'explicit_indirect_variable' => true,
        'explicit_string_variable' => true,
        'general_phpdoc_annotation_remove' => ['annotations' => ['package', 'author']],
        'header_comment' => [
            'header' => $header,
            'commentType' => 'PHPDoc',
        ],
        'heredoc_to_nowdoc' => true,
        'list_syntax' => ['syntax' => 'short'],
        // Deactivated as this library does not really need it
        'mb_str_functions' => false,
        'method_chaining_indentation' => true,
        'native_function_invocation' => true,
        'no_null_property_initialization' => true,
        'no_php4_constructor' => true,
        'no_unreachable_default_argument_value' => true,
        'no_useless_else' => true,
        'no_useless_return' => true,
        'ordered_class_elements' => true,
        'ordered_imports' => true,
        'phpdoc_add_missing_param_annotation' => [
            'only_untyped' => false,
        ],
        'phpdoc_order' => true,
        'no_useless_else' => true,
        'no_useless_return' => true,
        'simplified_null_return' => true,
    ])
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->in('src')
            ->in('src-test')
            ->in('stubs')
            ->in('spec')
    )
    ->setUsingCache(false)
    ->setRiskyAllowed(true)
    ;
return $config;