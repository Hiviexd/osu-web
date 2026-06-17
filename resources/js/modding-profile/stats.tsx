// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ValueDisplay from 'components/value-display';
import UserModdingProfileJson from 'interfaces/user-modding-profile-json';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { formatNumber } from 'utils/html';
import { trans } from 'utils/lang';

const countRows = [
  [
    'ranked_beatmapset_count',
    'loved_beatmapset_count',
    'pending_beatmapset_count',
    'graveyard_beatmapset_count',
  ],
  [
    'guest_beatmapset_count',
    'nominated_beatmapset_count',
  ],
] as const;

type BeatmapsetCountKey = typeof countRows[number][number];

interface Props {
  user: UserModdingProfileJson;
}

export default class Stats extends React.PureComponent<Props> {
  render() {
    const rank = this.props.user.kudosu.rank;

    return (
      <div className='modding-profile-stats'>
        <div className='modding-profile-stats__row'>
          <ValueDisplay
            label={trans('users.show.rank.kudosu_simple')}
            modifiers='rank'
            value={
              <div className='rank-value rank-value--base'>
                {rank != null ? `#${formatNumber(rank)}` : '-'}
              </div>
            }
          />
        </div>
        {countRows.map((row, index) => (
          <div key={index} className='modding-profile-stats__row'>
            {row.map(this.renderEntry)}
          </div>
        ))}
      </div>
    );
  }

  private readonly renderEntry = (key: BeatmapsetCountKey) => {
    const section = key.replace('_beatmapset_count', '');

    return (
      <div key={key} className={classWithModifiers('modding-profile-stats__count', section)}>
        <div className='modding-profile-stats__count-heading'>
          <div className='modding-profile-stats__count-label'>
            {trans(`users.show.extra.beatmaps.${section}.title`)}
          </div>
          <div className='modding-profile-stats__count-line' aria-hidden />
        </div>
        <div className='modding-profile-stats__count-value'>
          {formatNumber(this.props.user[key])}
        </div>
      </div>
    );
  };
}
