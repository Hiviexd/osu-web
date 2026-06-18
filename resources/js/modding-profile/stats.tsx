// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ValueDisplay from 'components/value-display';
import UserModdingProfileJson from 'interfaces/user-modding-profile-json';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { formatNumber } from 'utils/html';
import { trans } from 'utils/lang';

const countKeys = [
  'ranked_beatmapset_count',
  'loved_beatmapset_count',
  'pending_beatmapset_count',
  'graveyard_beatmapset_count',
  'guest_beatmapset_count',
  'nominated_beatmapset_count',
] as const;

type BeatmapsetCountKey = typeof countKeys[number];

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
        <div className='modding-profile-stats__row'>
          {countKeys.map(this.renderEntry)}
        </div>
      </div>
    );
  }

  private readonly renderEntry = (key: BeatmapsetCountKey) => {
    const section = key.replace('_beatmapset_count', '');

    return (
      <div key={key} className={classWithModifiers('modding-profile-stats__count', section)}>
        <div className='modding-profile-stats__count-line' aria-hidden />
        <ValueDisplay
          label={trans(`users.show.extra.beatmaps.${section}.title`)}
          modifiers='rank'
          value={formatNumber(this.props.user[key])}
        />
      </div>
    );
  };
}
