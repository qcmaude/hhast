<?hh // strict
/**
 * Copyright (c) 2016, Facebook, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the BSD-style license found in the
 * LICENSE file in the root directory of this source tree. An additional
 * grant of patent rights can be found in the PATENTS file in the same
 * directory.
 *
 */

namespace Facebook\HHAST\__Private\Resolution;

use type Facebook\HHAST\{
  EditableNode,
  NamespaceBody,
  NamespaceDeclaration,
  NamespaceEmptyBody,
  Script,
  __Private\PerfCounter,
  __Private\ScopedPerfCounter,
};
use namespace Facebook\TypeAssert;
use namespace HH\Lib\{C, Str, Vec};

function get_current_namespace(
  EditableNode $node,
  vec<EditableNode> $parents,
): ?string {
  using (new ScopedPerfCounter(__FUNCTION__));
  $parents = vec($parents);

  $namespaces = Vec\filter(
    $parents,
    $parent ==> $parent instanceof NamespaceDeclaration,
  );

  invariant(
    C\count($namespaces) <= 1,
    "Can't nest namespace blocks",
  );

  // No blocks, just a declaration;
  if (C\is_empty($namespaces)) {
    using (new ScopedPerfCounter(__FUNCTION__.'#declaration')) {
      $root = $parents
        |> C\firstx($$)
        |> TypeAssert\instance_of(Script::class, $$);
      $ns = $root
        ->getDeclarations()
        ->getChildrenOfType(NamespaceDeclaration::class)
        |> C\first($$);
      if ($ns === null) {
        return null;
      }
      $body = $ns->getBody();
      invariant(
        $body->isMissing() || $body instanceof NamespaceEmptyBody,
        "if using namespace blocks, all code must be in a NS block - got %s",
        \get_class($body),
      );
      return $ns->getQualifiedNameAsString();
    }
  }

  using (new ScopedPerfCounter(__FUNCTION__.'#blocks'));

  return $namespaces
    |> C\firstx($$)
    |> TypeAssert\instance_of(NamespaceDeclaration::class, $$)
    |> $$->getName()->getCode()
    |> Str\trim($$)
    |> Str\strip_prefix($$, '\\')
    |> $$ === '' ? null : $$;
}
