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

namespace Facebook\HHAST;

/**
 * Testing that we can disable a specific linter. Using DontAwaitInALoopLinter
 * as the example.
 */
final class SuppressASTLinterAwaitTest extends TestCase {
  use LinterTestTrait;

  protected function getLinter(string $file): Linters\BaseLinter {
    return new Linters\DontAwaitInALoopLinter($file);
  }

  public function getCleanExamples(): array<array<string>> {
    // this tests that we can check for the comment in the parents until we hit a statement.
    return [
      [
        '<?hh '.
        'async function await_all<T>(vec<Awaitable<T>> $in): Awaitable<vec<T>> {'.
        '  $out = vec[];'.
        '  foreach ($in as $item) {'.
        '    /* HHAST_FIXME[DontAwaitInALoop] */ '.
        '    $out[] = await $item;'.
        '  }'.
        '  return $out;'.
        '}',
      ],
    ];
  }
}
